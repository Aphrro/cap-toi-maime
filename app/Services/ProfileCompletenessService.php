<?php

namespace App\Services;

use App\Models\Professional;
use Illuminate\Support\Collection;

class ProfileCompletenessService
{
    protected array $fieldWeights = [
        'first_name' => 10,
        'last_name' => 10,
        'email' => 10,
        'phone' => 10,
        'address' => 5,
        'city_id' => 5,
        'category_id' => 10,
        'bio' => 15,
    ];

    protected int $specialtiesWeight = 10;
    protected int $languagesWeight = 5;
    protected int $avatarWeight = 10;

    public function calculateCompleteness(Professional $professional): array
    {
        $totalWeight = array_sum($this->fieldWeights) + $this->specialtiesWeight + $this->languagesWeight + $this->avatarWeight;
        $earnedWeight = 0;
        $missingFields = [];

        // Check regular fields
        foreach ($this->fieldWeights as $field => $weight) {
            if (!empty($professional->$field)) {
                $earnedWeight += $weight;
            } else {
                $missingFields[] = $field;
            }
        }

        // Check specialties
        if ($professional->specialtiesRelation->isNotEmpty()) {
            $earnedWeight += $this->specialtiesWeight;
        } else {
            $missingFields[] = 'specialties';
        }

        // Check languages
        if (!empty($professional->languages) && is_array($professional->languages) && count($professional->languages) > 0) {
            $earnedWeight += $this->languagesWeight;
        } else {
            $missingFields[] = 'languages';
        }

        // Check avatar
        if ($professional->getFirstMediaUrl('avatar')) {
            $earnedWeight += $this->avatarWeight;
        } else {
            $missingFields[] = 'avatar';
        }

        $percentage = $totalWeight > 0 ? round(($earnedWeight / $totalWeight) * 100) : 0;

        return [
            'percentage' => $percentage,
            'missing' => $missingFields,
            'is_complete' => $percentage >= 80,
        ];
    }

    public function getIncompleteProfiles(int $threshold = 80): Collection
    {
        return Professional::with(['specialtiesRelation', 'media'])
            ->get()
            ->filter(function (Professional $professional) use ($threshold) {
                $completeness = $this->calculateCompleteness($professional);
                return $completeness['percentage'] < $threshold;
            })
            ->values();
    }

    public function getMissingFieldsLabels(array $missingFields): array
    {
        $labels = [
            'first_name' => 'Prenom',
            'last_name' => 'Nom',
            'email' => 'Email',
            'phone' => 'Telephone',
            'address' => 'Adresse',
            'city_id' => 'Ville',
            'category_id' => 'Categorie',
            'bio' => 'Biographie',
            'specialties' => 'Specialites',
            'languages' => 'Langues',
            'avatar' => 'Photo de profil',
        ];

        return array_map(fn($field) => $labels[$field] ?? $field, $missingFields);
    }
}
