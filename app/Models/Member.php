<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Member extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'phone',
        'membership_start', 'membership_end', 'status', 'admin_notes',
    ];

    protected $casts = [
        'membership_start' => 'date',
        'membership_end' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function eventRegistrations(): MorphMany
    {
        return $this->morphMany(EventRegistration::class, 'registrable');
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->first_name . ' ' . $this->last_name,
        );
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                     ->where('membership_end', '>=', now());
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeExpiringSoon($query, $days = 30)
    {
        return $query->where('status', 'active')
                     ->whereBetween('membership_end', [now(), now()->addDays($days)]);
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->membership_end >= now();
    }
}
