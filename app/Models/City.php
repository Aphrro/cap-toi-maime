<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class City extends Model
{
    use HasSlug;

    protected $fillable = ['name', 'slug', 'postal_code', 'canton_id', 'latitude', 'longitude'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function canton(): BelongsTo
    {
        return $this->belongsTo(Canton::class);
    }

    public function professionals(): HasMany
    {
        return $this->hasMany(Professional::class);
    }
}
