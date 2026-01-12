<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Professional;
use App\Models\Specialty;
use Livewire\Component;

class HomePage extends Component
{
    public string $search = '';

    public function quickSearch()
    {
        return redirect()->route('annuaire', ['search' => $this->search]);
    }

    public function render()
    {
        return view('livewire.home-page', [
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
