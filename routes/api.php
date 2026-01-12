<?php

use App\Http\Controllers\Api\TrackingController;
use App\Http\Controllers\Api\AssistantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Tracking endpoints
Route::prefix('track')->middleware('throttle:120,1')->group(function () {
    Route::post('/', [TrackingController::class, 'store']);
    Route::get('/session', [TrackingController::class, 'session']);
    Route::post('/questionnaire', [TrackingController::class, 'updateQuestionnaireData']);
    Route::post('/questionnaire/complete', [TrackingController::class, 'completeQuestionnaire']);
});

// Assistant endpoints
Route::prefix('assistant')->middleware('throttle:60,1')->group(function () {
    Route::get('/suggestions', [AssistantController::class, 'getSuggestions']);
    Route::get('/hints', [AssistantController::class, 'getHints']);
    Route::get('/navigation', [AssistantController::class, 'getNavigation']);
    Route::post('/suggestion/click', [AssistantController::class, 'trackSuggestionClick']);
    Route::post('/suggestion/dismiss', [AssistantController::class, 'dismissSuggestion']);
});
