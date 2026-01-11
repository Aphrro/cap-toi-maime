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
    ];

    protected $casts = [
        'specialties' => 'array',
        'languages' => 'array',
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'verified_at' => 'datetime',
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
}
