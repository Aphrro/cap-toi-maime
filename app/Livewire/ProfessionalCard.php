<?php

namespace App\Livewire;

use App\Models\Professional;
use Livewire\Component;

class ProfessionalCard extends Component
{
    public Professional $professional;

    public function render()
    {
        return view('livewire.professional-card');
    }
}
