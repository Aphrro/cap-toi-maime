<?php

namespace App\Livewire;

use App\Models\Faq;
use Livewire\Component;

class FaqPage extends Component
{
    public string $activeCategory = 'all';

    public function setCategory(string $category): void
    {
        $this->activeCategory = $category;
    }

    public function render()
    {
        $query = Faq::active();

        if ($this->activeCategory !== 'all') {
            $query->byCategory($this->activeCategory);
        }

        return view('livewire.faq-page', [
            'faqs' => $query->get(),
            'categories' => [
                'all' => 'Toutes les questions',
                'parents' => 'Parents / Membres',
                'pros' => 'Professionnels',
                'general' => 'Général',
            ],
        ])->layout('layouts.public', [
            'title' => 'FAQ - Cap Toi M\'aime',
        ]);
    }
}
