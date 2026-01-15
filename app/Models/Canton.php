<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Canton extends Model
{
    use HasSlug;

    protected $fillable = ['name', 'code', 'slug', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function professionals(): HasMany
    {
        return $this->hasManyThrough(Professional::class, City::class);
    }
}
