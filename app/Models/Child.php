<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'first_name',
        'age',
        'problematique',
        'description',
    ];

    protected $casts = [
        'age' => 'integer',
    ];

    public const PROBLEMATIQUES = [
        'phobie_scolaire' => 'Phobie scolaire',
        'refus_scolaire' => 'Refus scolaire',
        'anxiete' => 'Anxiete scolaire',
        'harcelement' => 'Harcelement',
        'tdah' => 'TDAH',
        'hpi' => 'Haut Potentiel (HPI)',
        'troubles_dys' => 'Troubles DYS',
        'decrochage' => 'Decrochage scolaire',
        'burn_out' => 'Burn-out scolaire',
        'autre' => 'Autre',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ParentProfile::class, 'parent_id');
    }

    public function getProblematiqueLabelAttribute(): string
    {
        return self::PROBLEMATIQUES[$this->problematique] ?? $this->problematique;
    }
}
