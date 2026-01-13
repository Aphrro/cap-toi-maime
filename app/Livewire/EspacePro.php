<?php

namespace App\Livewire;

use App\Models\Professional;
use App\Models\User;
use Livewire\Component;

class EspacePro extends Component
{
    public function getStatsProperty(): array
    {
        return [
            'pros_count' => Professional::where('is_active', true)
                ->where('validation_status', 'approved')
                ->count(),

            'members_count' => User::where('member_status', 'approved')
                ->count(),
        ];
    }

    public function render()
    {
        return view('livewire.espace-pro', [
            'stats' => $this->stats,
        ])->layout('layouts.public', [
            'title' => 'Espace Professionnels - Cap Toi M\'aime'
        ]);
    }
}
