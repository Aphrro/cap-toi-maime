/**
 * Cap Toi M'aime Smart Behavior Tracking
 * Analyzes user behavior in real-time for intelligent assistance
 */

class SmartTracker {
    constructor() {
        this.pageLoadTime = Date.now();
        this.lastActivityTime = Date.now();
        this.scrollData = {
            maxDepth: 0,
            directionChanges: 0,
            lastDirection: null,
            lastScrollY: 0,
            bounces: 0,
            timeAtBottom: 0,
            bottomReachedAt: null
        };
        this.mouseData = {
            hesitationCount: 0,
            hoverOnCta: 0,
            lastMoveTime: 0,
            exitIntentTriggered: false
        };
        this.clickData = {
            total: 0,
            rapidClicks: [],
            lastClickTime: 0,
            lastClickElement: null
        };
        this.formData = {
            started: false,
            fieldsInteracted: 0,
            abandoned: false
        };
        this.behaviorBuffer = [];
        this.analysisInterval = null;

        this.init();
    }

    init() {
        this.trackPageView();
        this.setupScrollTracking();
        this.setupMouseTracking();
        this.setupClickTracking();
        this.setupFormTracking();
        this.setupExitIntent();
        this.setupIdleDetection();
        this.startBehaviorAnalysis();
    }

    // ==================== SCROLL TRACKING ====================
    setupScrollTracking() {
        let ticking = false;

        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    this.analyzeScroll();
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });
    }

    analyzeScroll() {
        const scrollY = window.scrollY;
        const windowHeight = window.innerHeight;
        const docHeight = document.documentElement.scrollHeight;
        const scrollPercent = Math.round((scrollY / Math.max(1, docHeight - windowHeight)) * 100);

        // Track max depth
        if (scrollPercent > this.scrollData.maxDepth) {
            this.scrollData.maxDepth = scrollPercent;

            // Track milestone depths
            if ([25, 50, 75, 90].includes(scrollPercent)) {
                this.sendEvent('scroll', 'engagement', 'depth_milestone', { depth: scrollPercent });
            }
        }

        // Detect direction changes (potential confusion)
        const direction = scrollY > this.scrollData.lastScrollY ? 'down' : 'up';
        if (this.scrollData.lastDirection && direction !== this.scrollData.lastDirection) {
            this.scrollData.directionChanges++;
            if (this.scrollData.directionChanges > 3) {
                this.scrollData.bounces++;
            }
        }
        this.scrollData.lastDirection = direction;
        this.scrollData.lastScrollY = scrollY;

        // Track time at bottom
        if (scrollPercent >= 90) {
            if (!this.scrollData.bottomReachedAt) {
                this.scrollData.bottomReachedAt = Date.now();
            }
            this.scrollData.timeAtBottom = (Date.now() - this.scrollData.bottomReachedAt) / 1000;
        } else {
            this.scrollData.bottomReachedAt = null;
        }

        this.updateActivity();
    }

    // ==================== MOUSE TRACKING ====================
    setupMouseTracking() {
        let hoverTimeout = null;

        // Track mouse hesitation (stopped moving for 2+ seconds)
        document.addEventListener('mousemove', (e) => {
            const now = Date.now();

            if (this.mouseData.lastMoveTime && (now - this.mouseData.lastMoveTime) > 2000) {
                this.mouseData.hesitationCount++;
            }

            this.mouseData.lastMoveTime = now;
            this.updateActivity();
        }, { passive: true });

        // Track CTA hovers
        document.addEventListener('mouseover', (e) => {
            const cta = e.target.closest('a.bg-ctm-burgundy, button.bg-ctm-burgundy, [data-cta], .cta');
            if (cta) {
                clearTimeout(hoverTimeout);
                hoverTimeout = setTimeout(() => {
                    this.mouseData.hoverOnCta++;
                    this.sendEvent('hover', 'engagement', 'cta_hover', {
                        element: cta.textContent?.trim().substring(0, 30)
                    });
                }, 500); // Only count if hovered for 500ms+
            }
        }, { passive: true });

        document.addEventListener('mouseout', (e) => {
            const cta = e.target.closest('a.bg-ctm-burgundy, button.bg-ctm-burgundy, [data-cta], .cta');
            if (cta) {
                clearTimeout(hoverTimeout);
            }
        }, { passive: true });
    }

    setupExitIntent() {
        document.addEventListener('mouseout', (e) => {
            if (e.clientY <= 0 && !this.mouseData.exitIntentTriggered) {
                this.mouseData.exitIntentTriggered = true;
                this.sendEvent('exit_intent', 'engagement', 'detected', {
                    time_on_page: this.getTimeOnPage(),
                    scroll_depth: this.scrollData.maxDepth
                });

                // Dispatch event for assistant to catch
                window.dispatchEvent(new CustomEvent('user-exit-intent', {
                    detail: { timeOnPage: this.getTimeOnPage() }
                }));
            }
        }, { passive: true });
    }

    // ==================== CLICK TRACKING ====================
    setupClickTracking() {
        document.addEventListener('click', (e) => {
            const now = Date.now();
            this.clickData.total++;

            // Detect rapid clicks (same element within 1 second)
            if (this.clickData.lastClickElement === e.target &&
                (now - this.clickData.lastClickTime) < 1000) {
                this.clickData.rapidClicks.push(now);

                // Keep only recent rapid clicks
                this.clickData.rapidClicks = this.clickData.rapidClicks.filter(
                    t => now - t < 3000
                );

                // Detect rage clicks
                if (this.clickData.rapidClicks.length >= 3) {
                    this.sendEvent('rage_click', 'frustration', 'detected', {
                        element: this.getElementDescription(e.target),
                        count: this.clickData.rapidClicks.length
                    });

                    window.dispatchEvent(new CustomEvent('user-frustrated', {
                        detail: { type: 'rage_click' }
                    }));
                }
            } else {
                this.clickData.rapidClicks = [];
            }

            this.clickData.lastClickTime = now;
            this.clickData.lastClickElement = e.target;

            // Track specific click types
            this.trackClickType(e);
            this.updateActivity();
        });
    }

    trackClickType(e) {
        const target = e.target;

        // Professional card click
        const proCard = target.closest('[data-professional-id]');
        if (proCard) {
            this.sendEvent('click', 'professional', 'card_viewed', {
                professional_id: proCard.dataset.professionalId
            });
        }

        // Filter interaction
        const filter = target.closest('[data-filter], select, input[type="checkbox"]');
        if (filter) {
            this.sendEvent('filter', 'search', 'applied', {
                filter_type: filter.dataset?.filter || filter.name || 'unknown'
            });
        }

        // Back button / navigation
        if (target.closest('a[href*="back"], button[onclick*="back"], .back-button')) {
            this.sendEvent('navigation', 'behavior', 'back', {});
        }

        // Contact actions
        const contactLink = target.closest('a[href^="tel:"], a[href^="mailto:"], [data-contact]');
        if (contactLink) {
            this.sendEvent('contact', 'conversion', 'initiated', {
                type: contactLink.href?.startsWith('tel:') ? 'phone' : 'email'
            });
        }
    }

    // ==================== FORM TRACKING ====================
    setupFormTracking() {
        document.addEventListener('focusin', (e) => {
            if (e.target.matches('input, textarea, select')) {
                if (!this.formData.started) {
                    this.formData.started = true;
                    this.sendEvent('form', 'interaction', 'started', {
                        form_id: e.target.closest('form')?.id || 'unknown'
                    });
                }
                this.formData.fieldsInteracted++;
            }
        });

        // Track form abandonment
        window.addEventListener('beforeunload', () => {
            if (this.formData.started && this.formData.fieldsInteracted > 0) {
                const form = document.querySelector('form');
                if (form && !form.dataset.submitted) {
                    this.sendEventSync('form', 'interaction', 'abandoned', {
                        fields_completed: this.formData.fieldsInteracted
                    });
                }
            }
        });
    }

    // ==================== IDLE DETECTION ====================
    setupIdleDetection() {
        setInterval(() => {
            const idleTime = (Date.now() - this.lastActivityTime) / 1000;

            if (idleTime > 60 && idleTime < 65) {
                this.sendEvent('idle', 'behavior', 'detected', {
                    idle_seconds: Math.round(idleTime),
                    page: window.location.pathname
                });

                window.dispatchEvent(new CustomEvent('user-idle', {
                    detail: { seconds: idleTime }
                }));
            }
        }, 5000);
    }

    updateActivity() {
        this.lastActivityTime = Date.now();
    }

    // ==================== BEHAVIOR ANALYSIS ====================
    startBehaviorAnalysis() {
        // Send behavior data every 10 seconds
        this.analysisInterval = setInterval(() => {
            this.sendBehaviorSnapshot();
        }, 10000);

        // Also send on page unload
        window.addEventListener('beforeunload', () => {
            this.sendBehaviorSnapshot(true);
        });
    }

    sendBehaviorSnapshot(sync = false) {
        const data = {
            scroll: {
                depth: this.scrollData.maxDepth,
                direction_changes: this.scrollData.directionChanges,
                bounces: this.scrollData.bounces,
                time_at_bottom: this.scrollData.timeAtBottom,
                speed: this.calculateScrollSpeed()
            },
            mouse: {
                hesitation_count: this.mouseData.hesitationCount,
                hover_on_cta: this.mouseData.hoverOnCta,
                exit_intent: this.mouseData.exitIntentTriggered
            },
            clicks: {
                total: this.clickData.total,
                rapid_same_element: this.clickData.rapidClicks.length
            },
            time: {
                on_page: this.getTimeOnPage(),
                idle: (Date.now() - this.lastActivityTime) / 1000
            },
            page: window.location.pathname
        };

        if (sync) {
            this.sendEventSync('behavior_snapshot', 'analysis', 'periodic', data);
        } else {
            this.sendEvent('behavior_snapshot', 'analysis', 'periodic', data);

            // Also dispatch for Livewire to catch
            window.dispatchEvent(new CustomEvent('behavior-update', { detail: data }));
        }
    }

    calculateScrollSpeed() {
        // Simple approximation
        if (this.scrollData.directionChanges > 5) return 'erratic';
        if (this.scrollData.maxDepth > 50 && this.getTimeOnPage() < 10) return 'fast';
        if (this.scrollData.maxDepth < 30 && this.getTimeOnPage() > 30) return 'slow';
        return 'normal';
    }

    // ==================== UTILITY METHODS ====================
    getTimeOnPage() {
        return Math.round((Date.now() - this.pageLoadTime) / 1000);
    }

    getElementDescription(element) {
        if (!element) return 'unknown';
        const tag = element.tagName?.toLowerCase() || '';
        const className = element.className?.toString().substring(0, 50) || '';
        const text = element.textContent?.trim().substring(0, 20) || '';
        return `${tag}.${className}[${text}]`;
    }

    getCsrfToken() {
        const meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }

    async trackPageView() {
        await this.sendEvent('page_view', 'navigation', 'viewed', {
            url: window.location.pathname,
            referrer: document.referrer,
            title: document.title
        });
    }

    async sendEvent(type, category, action, data = {}) {
        try {
            await fetch('/api/track', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.getCsrfToken(),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ type, category, action, data }),
                keepalive: true
            });
        } catch (e) {
            console.warn('Tracking failed:', e);
        }
    }

    sendEventSync(type, category, action, data = {}) {
        const payload = JSON.stringify({ type, category, action, data });
        if (navigator.sendBeacon) {
            const blob = new Blob([payload], { type: 'application/json' });
            navigator.sendBeacon('/api/track', blob);
        }
    }

    // ==================== PUBLIC API ====================
    trackSearch(query, filters = {}, resultsCount = 0) {
        this.sendEvent('search', 'search', 'performed', {
            query,
            filters,
            results_count: resultsCount
        });

        if (resultsCount === 0) {
            window.dispatchEvent(new CustomEvent('search-no-results', {
                detail: { query, filters }
            }));
        }
    }

    trackQuestionnaireStep(step, data = {}) {
        this.sendEvent('questionnaire', 'questionnaire', 'step_completed', {
            step,
            ...data
        });
    }

    getBehaviorSummary() {
        return {
            timeOnPage: this.getTimeOnPage(),
            scrollDepth: this.scrollData.maxDepth,
            engagement: this.calculateEngagementScore(),
            frustrationSignals: this.getFrustrationSignals()
        };
    }

    calculateEngagementScore() {
        let score = 0;
        score += Math.min(30, this.getTimeOnPage() / 2); // Max 30 for time
        score += Math.min(30, this.scrollData.maxDepth / 3); // Max 30 for scroll
        score += Math.min(20, this.clickData.total * 3); // Max 20 for clicks
        score += Math.min(20, this.mouseData.hoverOnCta * 5); // Max 20 for CTA interest
        return Math.round(score);
    }

    getFrustrationSignals() {
        const signals = [];
        if (this.clickData.rapidClicks.length >= 3) signals.push('rage_clicks');
        if (this.scrollData.bounces >= 2) signals.push('scroll_bouncing');
        if (this.mouseData.hesitationCount >= 3) signals.push('hesitation');
        if (this.mouseData.exitIntentTriggered) signals.push('exit_intent');
        return signals;
    }
}

// Initialize tracker
window.smartTracker = new SmartTracker();

export default window.smartTracker;
