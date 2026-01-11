<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Canton extends Model
{
    use HasSlug;

    protected $fillable = ['name', 'code', 'slug'];

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
