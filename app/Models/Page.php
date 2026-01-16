<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'content',
        'meta',
        'is_active',
    ];

    protected $casts = [
        'content' => 'array',
        'meta' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Pages système (non supprimables)
     */
    public static array $systemPages = [
        'accueil',
        'a-propos',
        'contact',
        'faq',
        'espace-pro',
        'conditions-utilisation',
        'politique-confidentialite',
        'charte-ethique',
    ];

    /**
     * Trouver une page par son slug
     */
    public static function findBySlug(string $slug): ?self
    {
        return static::where('slug', $slug)->where('is_active', true)->first();
    }

    /**
     * Vérifie si c'est une page système
     */
    public function isSystemPage(): bool
    {
        return in_array($this->slug, self::$systemPages);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
