<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TrackingService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TrackingController extends Controller
{
    public function __construct(
        protected TrackingService $tracking
    ) {}

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'type' => 'required|string|max:50',
            'category' => 'required|string|max:30',
            'action' => 'required|string|max:50',
            'label' => 'nullable|string|max:255',
            'data' => 'nullable|array',
        ]);

        $this->tracking->logEvent(
            $validated['type'],
            $validated['category'],
            $validated['action'],
            $validated['data'] ?? [],
            $validated['label'] ?? null
        );

        return response()->json(['status' => 'ok']);
    }

    public function session(): JsonResponse
    {
        $session = $this->tracking->getOrCreateSession();

        return response()->json([
            'session_id' => $session->id,
            'pages_viewed' => $session->pages_viewed,
            'questionnaire_completed' => $session->questionnaire_completed,
            'is_returning' => $this->tracking->isReturningVisitor(),
        ]);
    }

    public function updateQuestionnaireData(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'step' => 'required|integer|min:1|max:10',
            'data' => 'required|array',
        ]);

        $session = $this->tracking->getOrCreateSession();

        $questionnaireData = $session->questionnaire_data ?? [];
        $questionnaireData['current_step'] = $validated['step'];
        $questionnaireData['step_' . $validated['step']] = $validated['data'];

        $session->update([
            'questionnaire_data' => $questionnaireData,
            'last_activity_at' => now(),
        ]);

        return response()->json(['status' => 'ok']);
    }

    public function completeQuestionnaire(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'data' => 'required|array',
        ]);

        $session = $this->tracking->getOrCreateSession();
        $session->markQuestionnaireCompleted($validated['data']);

        return response()->json(['status' => 'ok']);
    }
}
