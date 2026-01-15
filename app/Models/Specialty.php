<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Specialty extends Model
{
    use HasSlug;

    protected $fillable = [
        'category_id',
        'slug',
        'name',
        'description',
        'icon',
        'order',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function professionals(): BelongsToMany
    {
        return $this->belongsToMany(Professional::class, 'professional_specialty');
    }

    public function synonyms(): HasMany
    {
        return $this->hasMany(SpecialtySynonym::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Find specialty by slug or one of its synonyms
     */
    public static function findBySlugOrSynonym(string $term): ?self
    {
        $specialty = self::where('slug', $term)->first();

        if (!$specialty) {
            $synonym = SpecialtySynonym::where('synonym', $term)->first();
            if ($synonym) {
                $specialty = $synonym->specialty;
            }
        }

        return $specialty;
    }
}
