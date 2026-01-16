<?php

namespace App\Livewire;

use App\Livewire\Concerns\WithPageContent;
use Livewire\Component;

class AboutPage extends Component
{
    use WithPageContent;

    public function mount(): void
    {
        $this->loadPageContent('a-propos');
    }

    public function render()
    {
        return view('livewire.about-page', [
            'heroTitle' => $this->getContent('hero.title', 'Pourquoi cet annuaire est né ?'),
            'introText' => $this->getContent('intro.text', ''),
            'whatItIsPoints' => $this->getContent('what_it_is.points', []),
            'ourPlusPoints' => $this->getContent('our_plus.points', []),
            'whyBuiltText' => $this->getContent('why_built.text', ''),
            'disclaimerText' => $this->getContent('disclaimer.text', ''),
        ])->layout('layouts.public');
    }
}
