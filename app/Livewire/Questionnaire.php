<?php

namespace App\Livewire;

use App\Models\Canton;
use Livewire\Component;

class Questionnaire extends Component
{
    public int $step = 1;
    public int $totalSteps = 5;

    // Étape 1
    public ?string $situation = null;

    // Étape 2
    public array $particularities = [];

    // Étape 3
    public ?int $childAge = null;
    public ?string $duration = null;

    // Étape 4
    public ?string $canton = null;
    public array $consultationModes = ['cabinet'];
    public string $language = 'FR';

    // Étape 5
    public array $priorities = [];

    public function nextStep()
    {
        if (!$this->validateStep()) {
            return;
        }

        if ($this->step < $this->totalSteps) {
            $this->step++;
        } else {
            $this->submitQuestionnaire();
        }
    }

    public function previousStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function toggleParticularity($value)
    {
        if (in_array($value, $this->particularities)) {
            $this->particularities = array_values(array_diff($this->particularities, [$value]));
        } else {
            $this->particularities[] = $value;
        }
    }

    public function toggleConsultationMode($mode)
    {
        if (in_array($mode, $this->consultationModes)) {
            $this->consultationModes = array_values(array_diff($this->consultationModes, [$mode]));
        } else {
            $this->consultationModes[] = $mode;
        }
    }

    public function togglePriority($priority)
    {
        if (in_array($priority, $this->priorities)) {
            $this->priorities = array_values(array_diff($this->priorities, [$priority]));
        } else {
            $this->priorities[] = $priority;
        }
    }

    private function validateStep(): bool
    {
        if ($this->step === 1 && !$this->situation) {
            $this->addError('situation', 'Veuillez sélectionner une situation');
            return false;
        }
        return true;
    }

    private function submitQuestionnaire()
    {
        session([
            'questionnaire' => [
                'situation' => $this->situation,
                'particularities' => $this->particularities,
                'child_age' => $this->childAge,
                'duration' => $this->duration,
                'canton' => $this->canton,
                'consultation_modes' => $this->consultationModes,
                'language' => $this->language,
                'priorities' => $this->priorities,
            ]
        ]);

        return redirect()->route('results');
    }

    public function render()
    {
        return view('livewire.questionnaire', [
            'cantons' => Canton::orderBy('name')->get(),
        ])->layout('layouts.public');
    }
}
