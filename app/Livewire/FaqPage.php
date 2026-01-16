<?php

namespace App\Livewire;

use App\Models\Faq;
use App\Models\Page;
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
        $page = Page::where('slug', 'faq')->where('is_active', true)->first();
        $content = $page?->content ?? [];

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
            'page' => $page,
            'content' => $content,
            'faqs' => $faqs,
            'categories' => [
                'all' => 'Toutes les questions',
                'parents' => 'Parents / Membres',
                'pros' => 'Professionnels',
                'general' => 'General',
            ],
        ])->layout('layouts.public', [
            'title' => $page?->meta['title'] ?? 'FAQ - Cap Toi M\'aime',
        ]);
    }
}
