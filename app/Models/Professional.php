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
        // Nouveaux champs profil
        'profile_photo',
        'video_url',
        'who_am_i',
        'my_approach',
        'availability_status',
        'reimbursements',
        'faq_availability',
        'faq_pricing',
        'faq_cancellation',
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
        // Nouveaux champs
        'reimbursements' => 'array',
    ];

    public const REIMBURSEMENT_OPTIONS = [
        'lamal' => 'LAMal',
        'lca' => 'LCA',
        'asca' => 'ASCA',
        'rme' => 'RME',
        'ai' => 'AI',
        'bourses' => 'Bourses',
    ];

    public const AVAILABILITY_STATUSES = [
        'available' => 'Disponible',
        'limited' => 'RDV sous 2-4 sem.',
        'waitlist' => 'Liste d\'attente',
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

    /**
     * Get availability badge info
     */
    public function getAvailabilityBadgeAttribute(): array
    {
        return match($this->availability_status) {
            'available' => ['color' => 'green', 'label' => 'Disponible'],
            'limited' => ['color' => 'orange', 'label' => 'RDV sous 2-4 sem.'],
            'waitlist' => ['color' => 'gray', 'label' => 'Liste d\'attente'],
            default => ['color' => 'gray', 'label' => 'Non renseigne'],
        };
    }

    /**
     * Get formatted reimbursements list
     */
    public function getReimbursementsListAttribute(): array
    {
        return collect($this->reimbursements ?? [])
            ->map(fn($code) => self::REIMBURSEMENT_OPTIONS[$code] ?? $code)
            ->toArray();
    }

    /**
     * Get video embed URL (YouTube/Vimeo)
     */
    public function getVideoEmbedUrlAttribute(): ?string
    {
        if (!$this->video_url) {
            return null;
        }

        // YouTube
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $this->video_url, $matches)) {
            return "https://www.youtube.com/embed/{$matches[1]}";
        }

        // Vimeo
        if (preg_match('/vimeo\.com\/(\d+)/', $this->video_url, $matches)) {
            return "https://player.vimeo.com/video/{$matches[1]}";
        }

        return $this->video_url;
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

    /**
     * Many-to-many relation with reimbursement types
     */
    public function reimbursementTypes(): BelongsToMany
    {
        return $this->belongsToMany(ReimbursementType::class, 'professional_reimbursement');
    }

    /**
     * Many-to-many relation with languages (new pivot table)
     */
    public function languagesRelation(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'professional_language');
    }

    /**
     * Relation avec le canton via la ville
     */
    public function canton(): BelongsTo
    {
        return $this->belongsTo(Canton::class);
    }

    /**
     * Relation avec la profession
     */
    public function profession(): BelongsTo
    {
        return $this->belongsTo(Profession::class);
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
