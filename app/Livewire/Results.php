<?php

namespace App\Livewire;

use App\Services\ProfessionalMatcher;
use Livewire\Component;

class Results extends Component
{
    public array $questionnaire = [];
    public $professionals;
    public array $recommendations = [];

    public function mount()
    {
        $this->questionnaire = session('questionnaire', []);

        if (empty($this->questionnaire)) {
            return redirect()->route('questionnaire');
        }

        // Utiliser le service de matching
        $matcher = new ProfessionalMatcher();
        $criteria = ProfessionalMatcher::fromQuestionnaire($this->questionnaire);
        $this->professionals = $matcher->match($criteria);

        // Générer les recommandations textuelles
        $this->recommendations = $this->generateRecommendations();
    }

    private function generateRecommendations(): array
    {
        $recs = [];
        $particularities = $this->questionnaire['particularities'] ?? [];
        $situation = $this->questionnaire['situation'] ?? '';

        // Selon les particularités neuro
        if (in_array('hpi', $particularities) ||
            in_array('tdah', $particularities) ||
            in_array('tsa', $particularities) ||
            in_array('dys', $particularities)) {
            $recs[] = [
                'type' => 'Neuropsychologue',
                'reason' => 'pour un bilan complet et identifier les besoins spécifiques',
                'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'
            ];
        }

        // Selon la situation
        if (in_array($situation, ['phobie', 'unknown'])) {
            $recs[] = [
                'type' => 'Psychologue',
                'reason' => 'pour un suivi thérapeutique et gérer l\'anxiété',
                'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'
            ];
        }

        if ($situation === 'refus') {
            $recs[] = [
                'type' => 'Coach scolaire',
                'reason' => 'pour retrouver la motivation et définir des objectifs',
                'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'
            ];
        }

        if ($situation === 'decrochage') {
            $recs[] = [
                'type' => 'Thérapeute familial',
                'reason' => 'pour un soutien global de la famille',
                'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'
            ];
        }

        // Harcèlement
        if (in_array('harcelement', $particularities)) {
            $recs[] = [
                'type' => 'Spécialiste harcèlement',
                'reason' => 'pour accompagner la situation de harcèlement',
                'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'
            ];
        }

        // Toujours suggérer un coach pour le retour si pas déjà présent
        $types = array_column($recs, 'type');
        if (!in_array('Coach scolaire', $types) && count($recs) < 3) {
            $recs[] = [
                'type' => 'Coach scolaire',
                'reason' => 'pour préparer le retour à l\'école en douceur',
                'icon' => 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z'
            ];
        }

        return array_slice($recs, 0, 3);
    }

    public function render()
    {
        return view('livewire.results')->layout('layouts.public');
    }
}
