<?php

namespace App\Livewire;

use App\Livewire\Concerns\WithPageContent;
use App\Models\Category;
use App\Models\Professional;
use App\Models\Specialty;
use Livewire\Component;

class HomePage extends Component
{
    use WithPageContent;

    public string $search = '';

    public function mount(): void
    {
        $this->loadPageContent('accueil');
    }

    public function quickSearch()
    {
        return redirect()->route('annuaire', ['search' => $this->search]);
    }

    public function render()
    {
        return view('livewire.home-page', [
            // Contenu CMS
            'heroTitle' => $this->getContent('hero.title', 'Trouvez des thérapeutes disponibles, proches de chez vous et formés au refus scolaire anxieux.'),
            'heroSubtitle' => $this->getContent('hero.subtitle', 'Un annuaire de thérapeutes tops et dispos, qui connaissent vraiment la phobie scolaire, et que l\'équipe Cap Toi M\'aime connaît et recommande.'),
            'heroCtaText' => $this->getContent('hero.cta_text', 'Commencez maintenant'),
            'heroCtaLink' => $this->getContent('hero.cta_link', '/questionnaire'),

            'ctaFinalTitle' => $this->getContent('cta_final.title', 'Prêts à trouver le professionnel qui vous convient à vous et à votre enfant ?'),
            'ctaFinalButtonText' => $this->getContent('cta_final.button_text', 'Commencez maintenant'),
            'ctaFinalButtonLink' => $this->getContent('cta_final.button_link', '/questionnaire'),

            // Données dynamiques (inchangé)
            'categories' => Category::active()->ordered()->limit(6)->get(),
            'specialties' => Specialty::active()
                ->whereIn('slug', [
                    'phobie_scolaire', 'bilan_hpi', 'bilan_tdah',
                    'anxiete_enfant', 'bilan_tsa', 'harcelement_scolaire'
                ])
                ->get(),
            'featuredPros' => Professional::where('is_featured', true)
                ->where('is_active', true)
                ->where('validation_status', 'approved')
                ->with(['category', 'city.canton'])
                ->limit(3)
                ->get(),
        ])->layout('layouts.public');
    }
}
