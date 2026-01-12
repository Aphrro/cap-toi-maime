<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPreference extends Model
{
    protected $fillable = [
        'user_id',
        'saved_searches',
        'favorite_professionals',
        'dismissed_suggestions',
        'preferred_canton',
        'preferred_specialties',
    ];

    protected $casts = [
        'saved_searches' => 'array',
        'favorite_professionals' => 'array',
        'dismissed_suggestions' => 'array',
        'preferred_specialties' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function addSavedSearch(array $search): void
    {
        $searches = $this->saved_searches ?? [];
        $searches[] = array_merge($search, ['saved_at' => now()->toISOString()]);
        $this->update(['saved_searches' => array_slice($searches, -10)]);
    }

    public function addFavoriteProfessional(int $professionalId): void
    {
        $favorites = $this->favorite_professionals ?? [];
        if (!in_array($professionalId, $favorites)) {
            $favorites[] = $professionalId;
            $this->update(['favorite_professionals' => $favorites]);
        }
    }

    public function removeFavoriteProfessional(int $professionalId): void
    {
        $favorites = $this->favorite_professionals ?? [];
        $favorites = array_filter($favorites, fn($id) => $id !== $professionalId);
        $this->update(['favorite_professionals' => array_values($favorites)]);
    }

    public function dismissSuggestion(string $suggestionId): void
    {
        $dismissed = $this->dismissed_suggestions ?? [];
        if (!in_array($suggestionId, $dismissed)) {
            $dismissed[] = $suggestionId;
            $this->update(['dismissed_suggestions' => $dismissed]);
        }
    }

    public function isSuggestionDismissed(string $suggestionId): bool
    {
        return in_array($suggestionId, $this->dismissed_suggestions ?? []);
    }
}
