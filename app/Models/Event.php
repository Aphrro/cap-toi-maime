<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'start_date', 'end_date',
        'location', 'address', 'max_professionals', 'max_members',
        'status', 'image',
        // Nouveaux champs
        'event_type',
        'registration_required',
        'registration_url',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_required' => 'boolean',
    ];

    public const EVENT_TYPES = [
        'general' => 'Général',
        'speed_dating' => 'Speed Dating',
        'conference' => 'Conférence',
        'workshop' => 'Atelier',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title . '-' . now()->format('Y-m-d'));
            }
        });
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    /**
     * Professionnels inscrits à cet événement (pour Speed Dating)
     */
    public function professionals(): BelongsToMany
    {
        return $this->belongsToMany(Professional::class, 'event_professional')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function professionalRegistrations()
    {
        return $this->registrations()->where('registrable_type', Professional::class);
    }

    public function memberRegistrations()
    {
        return $this->registrations()->where('registrable_type', Member::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }
}
