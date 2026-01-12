/**
 * Cap Toi M'aime User Tracking Module
 * Tracks user behavior for personalized recommendations
 */

class UserTracker {
    constructor() {
        this.sessionId = null;
        this.pageLoadTime = Date.now();
        this.maxScrollDepth = 0;
        this.isInitialized = false;
        this.eventQueue = [];
        this.isProcessing = false;
    }

    init() {
        if (this.isInitialized) return;
        this.isInitialized = true;

        this.trackPageView();
        this.setupScrollTracking();
        this.setupClickTracking();
        this.setupVisibilityTracking();
        this.setupLinkTracking();
        this.processQueue();
    }

    async trackPageView() {
        await this.sendEvent('page_view', 'navigation', 'viewed', {
            url: window.location.pathname,
            referrer: document.referrer,
            title: document.title,
            query: window.location.search
        });
    }

    setupScrollTracking() {
        let ticking = false;

        const onScroll = () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    const scrollPercent = Math.round(
                        (window.scrollY / Math.max(1, document.body.scrollHeight - window.innerHeight)) * 100
                    );

                    if (scrollPercent > this.maxScrollDepth) {
                        this.maxScrollDepth = scrollPercent;

                        // Track at key milestones
                        if ([25, 50, 75, 90].includes(scrollPercent)) {
                            this.sendEvent('scroll', 'engagement', 'depth', {
                                depth: scrollPercent
                            });
                        }
                    }
                    ticking = false;
                });
                ticking = true;
            }
        };

        window.addEventListener('scroll', onScroll, { passive: true });
    }

    setupClickTracking() {
        document.addEventListener('click', (e) => {
            // Track elements with data-track attribute
            const trackElement = e.target.closest('[data-track]');
            if (trackElement) {
                const trackData = this.parseTrackData(trackElement.dataset.track);
                this.sendEvent('click', trackData.category || 'interaction',
                    trackData.action || 'clicked', trackData);
            }

            // Track button clicks
            const button = e.target.closest('button, [role="button"]');
            if (button && !trackElement) {
                this.sendEvent('click', 'button', 'clicked', {
                    text: button.textContent?.trim().substring(0, 50),
                    class: button.className?.substring(0, 100)
                });
            }

            // Track CTA clicks
            const cta = e.target.closest('.cta, [data-cta]');
            if (cta) {
                this.sendEvent('click', 'cta', 'clicked', {
                    text: cta.textContent?.trim().substring(0, 50),
                    href: cta.href || null
                });
            }
        });
    }

    setupLinkTracking() {
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a[href]');
            if (!link) return;

            const href = link.getAttribute('href');

            // Track external links
            if (href && (href.startsWith('http') && !href.includes(window.location.hostname))) {
                this.sendEvent('click', 'external_link', 'clicked', {
                    url: href,
                    text: link.textContent?.trim().substring(0, 50)
                });
            }

            // Track phone/email links
            if (href?.startsWith('tel:')) {
                this.sendEvent('click', 'contact', 'phone_clicked', {
                    phone: href.replace('tel:', '')
                });
            }
            if (href?.startsWith('mailto:')) {
                this.sendEvent('click', 'contact', 'email_clicked', {
                    email: href.replace('mailto:', '')
                });
            }

            // Track professional card clicks
            if (link.closest('[data-professional-id]')) {
                const card = link.closest('[data-professional-id]');
                this.sendEvent('click', 'professional', 'card_clicked', {
                    professional_id: card.dataset.professionalId
                });
            }
        });
    }

    setupVisibilityTracking() {
        // Track page visibility changes
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                this.sendEvent('visibility', 'engagement', 'hidden', {
                    time_on_page: this.getTimeOnPage(),
                    scroll_depth: this.maxScrollDepth
                });
            } else {
                this.sendEvent('visibility', 'engagement', 'visible', {});
            }
        });

        // Track page exit
        window.addEventListener('beforeunload', () => {
            this.sendEventSync('page_exit', 'navigation', 'left', {
                time_on_page: this.getTimeOnPage(),
                scroll_depth: this.maxScrollDepth
            });
        });
    }

    getTimeOnPage() {
        return Math.round((Date.now() - this.pageLoadTime) / 1000);
    }

    parseTrackData(dataString) {
        if (!dataString) return {};

        try {
            return JSON.parse(dataString);
        } catch (e) {
            // Try parsing as key=value pairs
            const data = {};
            dataString.split(',').forEach(pair => {
                const [key, value] = pair.split(':').map(s => s.trim());
                if (key && value) data[key] = value;
            });
            return data;
        }
    }

    async sendEvent(type, category, action, data = {}) {
        this.eventQueue.push({ type, category, action, data, timestamp: Date.now() });
        this.processQueue();
    }

    sendEventSync(type, category, action, data = {}) {
        const payload = JSON.stringify({ type, category, action, data });

        // Use sendBeacon for reliable delivery on page exit
        if (navigator.sendBeacon) {
            const blob = new Blob([payload], { type: 'application/json' });
            navigator.sendBeacon('/api/track', blob);
        }
    }

    async processQueue() {
        if (this.isProcessing || this.eventQueue.length === 0) return;

        this.isProcessing = true;

        while (this.eventQueue.length > 0) {
            const event = this.eventQueue.shift();

            try {
                await fetch('/api/track', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.getCsrfToken(),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        type: event.type,
                        category: event.category,
                        action: event.action,
                        data: event.data
                    }),
                    keepalive: true
                });
            } catch (e) {
                console.warn('Tracking failed:', e);
                // Re-add to queue on failure (max 3 retries)
                if (!event.retries || event.retries < 3) {
                    event.retries = (event.retries || 0) + 1;
                    this.eventQueue.push(event);
                }
            }

            // Small delay between events
            await new Promise(resolve => setTimeout(resolve, 100));
        }

        this.isProcessing = false;
    }

    getCsrfToken() {
        const meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }

    // Public API for manual tracking
    track(category, action, data = {}) {
        this.sendEvent('custom', category, action, data);
    }

    trackSearch(query, filters = {}, resultsCount = 0) {
        this.sendEvent('search', 'search', 'performed', {
            query,
            filters,
            results_count: resultsCount
        });
    }

    trackFilter(filterName, filterValue) {
        this.sendEvent('filter', 'search', 'applied', {
            filter_name: filterName,
            filter_value: filterValue
        });
    }

    trackProfessionalView(professionalId, professionalName) {
        this.sendEvent('view', 'professional', 'viewed', {
            professional_id: professionalId,
            professional_name: professionalName
        });
    }

    trackQuestionnaireStep(step, data = {}) {
        this.sendEvent('questionnaire', 'questionnaire', 'step_completed', {
            step,
            ...data
        });
    }

    trackContactAction(type, professionalId = null) {
        this.sendEvent('contact', 'contact', type, {
            professional_id: professionalId
        });
    }
}

// Create global instance
window.userTracker = new UserTracker();

// Auto-initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => window.userTracker.init());
} else {
    window.userTracker.init();
}

export default window.userTracker;
