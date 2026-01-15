<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['category', 'question', 'answer', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function scopeForParents($query)
    {
        return $query->where('category', 'parents');
    }

    public function scopeForPros($query)
    {
        return $query->where('category', 'pros');
    }

    public function scopeGeneral($query)
    {
        return $query->where('category', 'general');
    }
}
