<?php

namespace App\Livewire;

use App\Models\Professional;
use Livewire\Component;

class ProfessionalShow extends Component
{
    public Professional $professional;

    public function mount(Professional $professional): void
    {
        if (!$professional->is_active) {
            abort(404);
        }

        $this->professional = $professional;

        // Increment views count
        $professional->increment('views_count');
    }

    public function render()
    {
        return view('livewire.professional-show', [
            'professional' => $this->professional->load(['category', 'city.canton']),
        ])->layout('layouts.public');
    }
}
