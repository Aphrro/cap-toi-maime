<?php

namespace App\Livewire;

use App\Models\Page;
use Livewire\Component;

class AboutPage extends Component
{
    public function render()
    {
        $page = Page::where('slug', 'a-propos')->where('is_active', true)->first();
        $content = $page?->content ?? [];

        return view('livewire.about-page', [
            'page' => $page,
            'content' => $content,
        ])->layout('layouts.public', [
            'title' => $page?->meta['title'] ?? 'A propos - Cap Toi M\'aime',
        ]);
    }
}
