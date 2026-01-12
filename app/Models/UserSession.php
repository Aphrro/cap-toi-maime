<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserSession extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'visitor_id',
        'device_type',
        'referrer',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'landing_page',
        'questionnaire_data',
        'pages_viewed',
        'professionals_viewed',
        'questionnaire_completed',
        'contact_initiated',
        'started_at',
        'last_activity_at',
    ];

    protected $casts = [
        'questionnaire_data' => 'array',
        'questionnaire_completed' => 'boolean',
        'contact_initiated' => 'boolean',
        'started_at' => 'datetime',
        'last_activity_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(UserEvent::class, 'session_id');
    }

    public function incrementPagesViewed(): void
    {
        $this->increment('pages_viewed');
        $this->touch('last_activity_at');
    }

    public function incrementProfessionalsViewed(): void
    {
        $this->increment('professionals_viewed');
        $this->touch('last_activity_at');
    }

    public function markQuestionnaireCompleted(array $data = []): void
    {
        $this->update([
            'questionnaire_completed' => true,
            'questionnaire_data' => $data,
            'last_activity_at' => now(),
        ]);
    }

    public function markContactInitiated(): void
    {
        $this->update([
            'contact_initiated' => true,
            'last_activity_at' => now(),
        ]);
    }

    public function getDurationInMinutes(): int
    {
        return $this->started_at->diffInMinutes($this->last_activity_at);
    }
}
