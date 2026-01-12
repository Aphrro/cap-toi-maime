<?php

namespace App\Livewire;

use Livewire\Component;

class EspacePro extends Component
{
    public function render()
    {
        return view('livewire.espace-pro')->layout('layouts.public', [
            'title' => 'Espace Professionnels - Cap Toi M\'aime'
        ]);
    }
}
