<?php

namespace App\Livewire;

use App\Models\Page;
use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        // Charger la page "accueil" depuis la base de donnees
        $page = Page::where('slug', 'accueil')->where('is_active', true)->first();
        $content = $page?->content ?? [];

        return view('livewire.home-page', [
            'page' => $page,
            'content' => $content,
        ])->layout('layouts.public', [
            'title' => $page?->meta['title'] ?? 'Cap Toi M\'aime - Annuaire RSA',
        ]);
    }
}
