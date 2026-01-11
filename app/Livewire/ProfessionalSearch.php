<?php

namespace App\Livewire;

use App\Models\Canton;
use App\Models\Category;
use App\Models\Professional;
use Livewire\Component;
use Livewire\WithPagination;

class ProfessionalSearch extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $categoryId = null;
    public ?int $cantonId = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryId' => ['except' => null],
        'cantonId' => ['except' => null],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategoryId(): void
    {
        $this->resetPage();
    }

    public function updatingCantonId(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $professionals = Professional::query()
            ->active()
            ->with(['category', 'city.canton'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('first_name', 'like', "%{$this->search}%")
                      ->orWhere('last_name', 'like', "%{$this->search}%")
                      ->orWhere('title', 'like', "%{$this->search}%");
                });
            })
            ->when($this->categoryId, function ($query) {
                $query->where('category_id', $this->categoryId);
            })
            ->when($this->cantonId, function ($query) {
                $query->whereHas('city', function ($q) {
                    $q->where('canton_id', $this->cantonId);
                });
            })
            ->orderByDesc('is_featured')
            ->orderByDesc('is_verified')
            ->paginate(12);

        return view('livewire.professional-search', [
            'professionals' => $professionals,
            'categories' => Category::active()->get(),
            'cantons' => Canton::orderBy('name')->get(),
        ])->layout('layouts.public');
    }
}
