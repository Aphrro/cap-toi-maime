<?php

namespace App\Services;

use App\Models\UserSession;
use App\Models\UserEvent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Collection;

class TrackingService
{
    private const VISITOR_COOKIE_NAME = 'ctm_visitor_id';
    private const COOKIE_LIFETIME = 60 * 24 * 365; // 1 year in minutes

    private ?UserSession $currentSession = null;

    public function getOrCreateSession(): UserSession
    {
        if ($this->currentSession) {
            return $this->currentSession;
        }

        $visitorId = $this->getOrCreateVisitorId();
        $session = $this->findActiveSession($visitorId);

        if (!$session) {
            $session = $this->createSession($visitorId);
        } else {
            $session->touch('last_activity_at');
        }

        $this->currentSession = $session;

        return $session;
    }

    public function logEvent(
        string $type,
        string $category,
        string $action,
        ?array $data = null,
        ?string $label = null
    ): UserEvent {
        $session = $this->getOrCreateSession();

        $event = UserEvent::create([
            'session_id' => $session->id,
            'event_type' => $type,
            'event_category' => $category,
            'event_action' => $action,
            'event_label' => $label,
            'event_data' => $data,
            'page_url' => request()->path(),
            'time_on_page' => $data['time_on_page'] ?? null,
            'scroll_depth' => $data['scroll_depth'] ?? null,
            'created_at' => now(),
        ]);

        // Update session counters based on event type
        if ($type === 'page_view') {
            $session->incrementPagesViewed();
        }

        if ($category === 'professional' && $action === 'viewed') {
            $session->incrementProfessionalsViewed();
        }

        return $event;
    }

    public function updateSessionActivity(): void
    {
        $session = $this->getOrCreateSession();
        $session->touch('last_activity_at');
    }

    public function getSessionMetrics(string $sessionId): array
    {
        $session = UserSession::findOrFail($sessionId);
        $events = $session->events;

        return [
            'duration_minutes' => $session->getDurationInMinutes(),
            'pages_viewed' => $session->pages_viewed,
            'professionals_viewed' => $session->professionals_viewed,
            'questionnaire_completed' => $session->questionnaire_completed,
            'contact_initiated' => $session->contact_initiated,
            'total_events' => $events->count(),
            'event_breakdown' => $events->groupBy('event_type')->map->count(),
            'scroll_depths' => $events->whereNotNull('scroll_depth')->pluck('scroll_depth'),
            'average_time_per_page' => $events->whereNotNull('time_on_page')->avg('time_on_page'),
        ];
    }

    public function getUserJourney(string $sessionId): Collection
    {
        return UserEvent::where('session_id', $sessionId)
            ->orderBy('created_at')
            ->get()
            ->map(fn($event) => [
                'type' => $event->event_type,
                'category' => $event->event_category,
                'action' => $event->event_action,
                'page' => $event->page_url,
                'time' => $event->created_at->format('H:i:s'),
                'data' => $event->event_data,
            ]);
    }

    public function getRecentEvents(int $limit = 10): Collection
    {
        $session = $this->getOrCreateSession();

        return $session->events()
            ->latest('created_at')
            ->limit($limit)
            ->get();
    }

    public function hasVisitedPage(string $pagePattern): bool
    {
        $session = $this->getOrCreateSession();

        return $session->events()
            ->where('event_type', 'page_view')
            ->where('page_url', 'like', $pagePattern)
            ->exists();
    }

    public function getPageViewCount(string $pagePattern = '%'): int
    {
        $session = $this->getOrCreateSession();

        return $session->events()
            ->where('event_type', 'page_view')
            ->where('page_url', 'like', $pagePattern)
            ->count();
    }

    public function getPreviousSessionCount(): int
    {
        $visitorId = $this->getOrCreateVisitorId();

        return UserSession::where('visitor_id', $visitorId)
            ->where('id', '!=', $this->getOrCreateSession()->id)
            ->count();
    }

    public function isReturningVisitor(): bool
    {
        return $this->getPreviousSessionCount() > 0;
    }

    protected function getOrCreateVisitorId(): string
    {
        $visitorId = request()->cookie(self::VISITOR_COOKIE_NAME);

        if (!$visitorId) {
            $visitorId = Str::uuid()->toString();
            Cookie::queue(
                self::VISITOR_COOKIE_NAME,
                $visitorId,
                self::COOKIE_LIFETIME,
                '/',
                null,
                true,
                true
            );
        }

        return $visitorId;
    }

    protected function findActiveSession(string $visitorId): ?UserSession
    {
        // Consider session active if last activity was within 30 minutes
        return UserSession::where('visitor_id', $visitorId)
            ->where('last_activity_at', '>=', now()->subMinutes(30))
            ->latest('last_activity_at')
            ->first();
    }

    protected function createSession(string $visitorId): UserSession
    {
        $request = request();

        return UserSession::create([
            'visitor_id' => $visitorId,
            'user_id' => auth()->id(),
            'device_type' => $this->detectDeviceType(),
            'referrer' => $request->header('referer'),
            'utm_source' => $request->query('utm_source'),
            'utm_medium' => $request->query('utm_medium'),
            'utm_campaign' => $request->query('utm_campaign'),
            'landing_page' => $request->path(),
            'started_at' => now(),
            'last_activity_at' => now(),
        ]);
    }

    protected function detectDeviceType(): string
    {
        $userAgent = request()->userAgent() ?? '';

        if (preg_match('/mobile|android|iphone|ipad|ipod/i', $userAgent)) {
            if (preg_match('/ipad|tablet/i', $userAgent)) {
                return 'tablet';
            }
            return 'mobile';
        }

        return 'desktop';
    }
}
