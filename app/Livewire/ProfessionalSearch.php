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
    public array $selectedReimbursements = [];
    public string $sortBy = 'name';

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryId' => ['except' => null],
        'cantonId' => ['except' => null],
        'sortBy' => ['except' => 'name'],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategoryId(): void
    {
        // Réinitialiser les spécialités sélectionnées quand la catégorie change
        $this->selectedSpecialties = [];
        $this->resetPage();
    }

    public function updatingCantonId(): void
    {
        $this->resetPage();
    }

    public function updatedSortBy(): void
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

    public function toggleReimbursement($code)
    {
        if (in_array($code, $this->selectedReimbursements)) {
            $this->selectedReimbursements = array_values(array_diff($this->selectedReimbursements, [$code]));
        } else {
            $this->selectedReimbursements[] = $code;
        }
        $this->resetPage();
    }

    public function resetAllFilters()
    {
        $this->search = '';
        $this->categoryId = null;
        $this->cantonId = null;
        $this->selectedSpecialties = [];
        $this->selectedReimbursements = [];
        $this->sortBy = 'name';
        $this->resetPage();
    }

    public function clearSpecialties()
    {
        $this->selectedSpecialties = [];
        $this->resetPage();
    }

    public function clearReimbursements()
    {
        $this->selectedReimbursements = [];
        $this->resetPage();
    }

    public function render()
    {
        $professionals = Professional::query()
            ->active()
            ->approved()
            ->with(['category', 'city.canton', 'specialties'])
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
                $query->whereHas('specialties', function ($q) {
                    $q->whereIn('specialties.id', $this->selectedSpecialties);
                });
            })
            ->when(!empty($this->selectedReimbursements), function ($query) {
                foreach ($this->selectedReimbursements as $reimbursement) {
                    $query->whereJsonContains('reimbursements', $reimbursement);
                }
            });

        // Appliquer le tri
        switch ($this->sortBy) {
            case 'canton':
                $professionals->join('cities', 'professionals.city_id', '=', 'cities.id')
                    ->join('cantons', 'cities.canton_id', '=', 'cantons.id')
                    ->orderBy('cantons.name')
                    ->select('professionals.*');
                break;
            case 'verified':
                $professionals->orderByDesc('is_verified')->orderBy('last_name');
                break;
            case 'name':
            default:
                $professionals->orderBy('last_name')->orderBy('first_name');
                break;
        }

        $professionals = $professionals->paginate(12);

        // Filtrer les spécialités selon la catégorie sélectionnée
        $specialtiesFilter = Specialty::active()
            ->when($this->categoryId, function ($query) {
                $query->where('category_id', $this->categoryId);
            })
            ->ordered()
            ->get();

        return view('livewire.professional-search', [
            'professionals' => $professionals,
            'categories' => Category::active()->get(),
            'cantons' => Canton::orderBy('name')->get(),
            'specialtiesFilter' => $specialtiesFilter,
            'reimbursementOptions' => Professional::REIMBURSEMENT_OPTIONS,
        ])->layout('layouts.public');
    }
}
