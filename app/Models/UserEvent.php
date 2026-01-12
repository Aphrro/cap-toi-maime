<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserEvent extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'session_id',
        'event_type',
        'event_category',
        'event_action',
        'event_label',
        'event_data',
        'page_url',
        'time_on_page',
        'scroll_depth',
        'created_at',
    ];

    protected $casts = [
        'event_data' => 'array',
        'created_at' => 'datetime',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(UserSession::class, 'session_id');
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('event_type', $type);
    }

    public function scopeOfCategory($query, string $category)
    {
        return $query->where('event_category', $category);
    }

    public function scopeRecent($query, int $minutes = 30)
    {
        return $query->where('created_at', '>=', now()->subMinutes($minutes));
    }
}
