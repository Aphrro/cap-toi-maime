<?php

namespace App\Livewire;

use App\Models\Faq;
use Illuminate\Support\Facades\Schema;
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
        $faqs = collect();

        try {
            if (Schema::hasTable('faqs')) {
                $query = Faq::active();

                if ($this->activeCategory !== 'all') {
                    $query->byCategory($this->activeCategory);
                }

                $faqs = $query->get();
            }
        } catch (\Exception $e) {
            // Table doesn't exist yet, return empty collection
        }

        return view('livewire.faq-page', [
            'faqs' => $faqs,
            'categories' => [
                'all' => 'Toutes les questions',
                'parents' => 'Parents / Membres',
                'pros' => 'Professionnels',
                'general' => 'General',
            ],
        ])->layout('layouts.public', [
            'title' => 'FAQ - Cap Toi M\'aime',
        ]);
    }
}
