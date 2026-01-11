<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Professional extends Model implements HasMedia
{
    use SoftDeletes, HasSlug, InteractsWithMedia;

    protected $fillable = [
        'first_name',
        'last_name',
        'title',
        'bio',
        'email',
        'phone',
        'website',
        'address',
        'city_id',
        'latitude',
        'longitude',
        'category_id',
        'specialties',
        'languages',
        'consultation_type',
        'is_verified',
        'is_featured',
        'is_active',
        'user_id',
        'validation_status',
        'rejection_reason',
        'validated_by',
        'validated_at',
    ];

    protected $casts = [
        'specialties' => 'array',
        'languages' => 'array',
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'verified_at' => 'datetime',
        'validated_at' => 'datetime',
    ];

    public const CONSULTATION_TYPES = [
        'cabinet' => 'En cabinet',
        'domicile' => 'A domicile',
        'en_ligne' => 'En ligne',
        'mixte' => 'Mixte',
    ];

    public const LANGUAGES = [
        'FR' => 'Francais',
        'DE' => 'Allemand',
        'EN' => 'Anglais',
        'IT' => 'Italien',
        'ES' => 'Espagnol',
        'PT' => 'Portugais',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['first_name', 'last_name'])
            ->saveSlugsTo('slug');
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->title} {$this->first_name} {$this->last_name}");
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeVerified(Builder $query): Builder
    {
        return $query->where('is_verified', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function specialtiesRelation()
    {
        return $this->belongsToMany(Specialty::class);
    }

    public function validator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('validation_status', 'pending');
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('validation_status', 'approved');
    }

    public function scopeRejected(Builder $query): Builder
    {
        return $query->where('validation_status', 'rejected');
    }

    public function isPending(): bool
    {
        return $this->validation_status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->validation_status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->validation_status === 'rejected';
    }

    public function approve(?int $userId = null): void
    {
        $this->update([
            'validation_status' => 'approved',
            'validated_by' => $userId ?? auth()->id(),
            'validated_at' => now(),
            'rejection_reason' => null,
            'is_active' => true,
        ]);
    }

    public function reject(string $reason, ?int $userId = null): void
    {
        $this->update([
            'validation_status' => 'rejected',
            'validated_by' => $userId ?? auth()->id(),
            'validated_at' => now(),
            'rejection_reason' => $reason,
            'is_active' => false,
        ]);
    }
}
