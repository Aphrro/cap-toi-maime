<?php

namespace App\Livewire;

use App\Models\Page;
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
        $page = Page::where('slug', 'espace-professionnels')->where('is_active', true)->first();
        $content = $page?->content ?? [];

        return view('livewire.espace-pro', [
            'page' => $page,
            'content' => $content,
            'stats' => $this->stats,
        ])->layout('layouts.public', [
            'title' => $page?->meta['title'] ?? 'Espace Professionnels - Cap Toi M\'aime'
        ]);
    }
}
