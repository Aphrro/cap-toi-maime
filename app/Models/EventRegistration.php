<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class EventRegistration extends Model
{
    protected $fillable = ['event_id', 'registrable_type', 'registrable_id', 'status', 'notes'];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function registrable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
