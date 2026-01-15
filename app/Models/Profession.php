<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profession extends Model
{
    protected $fillable = ['name', 'slug', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function professionals(): HasMany
    {
        return $this->hasMany(Professional::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
