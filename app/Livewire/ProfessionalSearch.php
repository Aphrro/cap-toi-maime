<?php

namespace App\Livewire;

use App\Models\Canton;
use App\Models\Category;
use App\Models\Professional;
use App\Models\Specialty;
use Livewire\Component;
use Livewire\WithPagination;

class ProfessionalSearch extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $categoryId = null;
    public ?int $cantonId = null;
    public array $selectedSpecialties = [];
    public $specialtiesFilter;

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryId' => ['except' => null],
        'cantonId' => ['except' => null],
    ];

    public function mount()
    {
        $this->specialtiesFilter = Specialty::where('is_active', true)->get();
    }

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

    public function toggleSpecialty($specialtyId)
    {
        if (in_array($specialtyId, $this->selectedSpecialties)) {
            $this->selectedSpecialties = array_values(array_diff($this->selectedSpecialties, [$specialtyId]));
        } else {
            $this->selectedSpecialties[] = $specialtyId;
        }
        $this->resetPage();
    }

    public function render()
    {
        $professionals = Professional::query()
            ->active()
            ->with(['category', 'city.canton', 'specialtiesRelation'])
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
            ->when(!empty($this->selectedSpecialties), function ($query) {
                $query->whereHas('specialtiesRelation', function ($q) {
                    $q->whereIn('specialties.id', $this->selectedSpecialties);
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
