<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'languages',
        'consultation_type',
        // Modes de consultation
        'mode_cabinet',
        'mode_visio',
        'mode_domicile',
        // Visibilite
        'is_verified',
        'is_featured',
        'is_active',
        'user_id',
        'validation_status',
        'rejection_reason',
        'validated_by',
        'validated_at',
        // Stats
        'views_count',
        'rating',
        'reviews_count',
        // Credentials
        'diplomas',
        'professional_number',
        'professional_number_type',
        'years_experience',
        'insurance_company',
        'insurance_number',
        'school_phobia_training',
        'credential_documents',
        'accepts_terms',
        'accepts_ethics',
    ];

    protected $casts = [
        'languages' => 'array',
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'verified_at' => 'datetime',
        'validated_at' => 'datetime',
        'diplomas' => 'array',
        'credential_documents' => 'array',
        'years_experience' => 'integer',
        'accepts_terms' => 'boolean',
        'accepts_ethics' => 'boolean',
        // Matching fields
        'mode_cabinet' => 'boolean',
        'mode_visio' => 'boolean',
        'mode_domicile' => 'boolean',
        'rating' => 'decimal:1',
        'reviews_count' => 'integer',
        'views_count' => 'integer',
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

    public const PROFESSIONAL_NUMBER_TYPES = [
        'GLN' => 'GLN (Global Location Number)',
        'RCC' => 'RCC (Registre des codes-creanciers)',
        'ASCA' => 'ASCA',
        'FSP' => 'FSP (Federation Suisse des Psychologues)',
        'ASP' => 'ASP (Association Suisse des Psychotherapeutes)',
        'SBAP' => 'SBAP',
        'autre' => 'Autre',
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

    /**
     * Get specialty slugs for matching
     */
    public function getSpecialtySlugsAttribute(): array
    {
        return $this->specialties->pluck('slug')->toArray();
    }

    // ═══════════════════════════════════════════════════════════
    // RELATIONS
    // ═══════════════════════════════════════════════════════════

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

    public function validator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    /**
     * Many-to-many relation with specialties
     */
    public function specialties(): BelongsToMany
    {
        return $this->belongsToMany(Specialty::class, 'professional_specialty');
    }

    // ═══════════════════════════════════════════════════════════
    // MEDIA
    // ═══════════════════════════════════════════════════════════

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    // ═══════════════════════════════════════════════════════════
    // SCOPES - VISIBILITE
    // ═══════════════════════════════════════════════════════════

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

    // ═══════════════════════════════════════════════════════════
    // SCOPES - VALIDATION
    // ═══════════════════════════════════════════════════════════

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

    /**
     * Scope for validated professionals (approved + active)
     */
    public function scopeValidated(Builder $query): Builder
    {
        return $query->where('validation_status', 'approved')
                     ->where('is_active', true);
    }

    // ═══════════════════════════════════════════════════════════
    // SCOPES - MATCHING
    // ═══════════════════════════════════════════════════════════

    public function scopeWithVisio(Builder $query): Builder
    {
        return $query->where('mode_visio', true);
    }

    public function scopeWithCabinet(Builder $query): Builder
    {
        return $query->where('mode_cabinet', true);
    }

    public function scopeWithDomicile(Builder $query): Builder
    {
        return $query->where('mode_domicile', true);
    }

    public function scopeInCanton(Builder $query, string $canton): Builder
    {
        return $query->whereHas('city.canton', function ($q) use ($canton) {
            $q->where('code', $canton);
        });
    }

    public function scopeSpeaksLanguage(Builder $query, string $language): Builder
    {
        return $query->whereJsonContains('languages', strtoupper($language));
    }

    public function scopeHasSpecialty(Builder $query, string|array $slugs): Builder
    {
        $slugs = is_array($slugs) ? $slugs : [$slugs];
        return $query->whereHas('specialties', function ($q) use ($slugs) {
            $q->whereIn('slug', $slugs);
        });
    }

    public function scopeInCategory(Builder $query, string $categorySlug): Builder
    {
        return $query->whereHas('category', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    // ═══════════════════════════════════════════════════════════
    // METHODS - VALIDATION
    // ═══════════════════════════════════════════════════════════

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
