<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactPage extends Component
{
    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $message = '';
    public bool $success = false;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|in:adhesion,annuaire,professionnel,autre',
            'message' => 'required|string|min:10|max:5000',
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required' => 'Veuillez entrer votre nom.',
            'name.min' => 'Le nom doit contenir au moins 2 caracteres.',
            'email.required' => 'Veuillez entrer votre email.',
            'email.email' => 'Veuillez entrer un email valide.',
            'subject.required' => 'Veuillez selectionner un sujet.',
            'subject.in' => 'Veuillez selectionner un sujet valide.',
            'message.required' => 'Veuillez entrer votre message.',
            'message.min' => 'Le message doit contenir au moins 10 caracteres.',
        ];
    }

    public function submit(): void
    {
        $validated = $this->validate();

        // Save to database
        $contactMessage = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $this->getSubjectLabel($validated['subject']),
            'message' => $validated['message'],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // Send email notification
        try {
            Mail::raw(
                "Nouveau message de contact\n\n" .
                "Nom: {$validated['name']}\n" .
                "Email: {$validated['email']}\n" .
                "Sujet: {$this->getSubjectLabel($validated['subject'])}\n\n" .
                "Message:\n{$validated['message']}",
                function ($mail) use ($validated) {
                    $mail->to(config('mail.from.address', 'hello@captoimaime.ch'))
                        ->replyTo($validated['email'], $validated['name'])
                        ->subject("[Contact Cap Toi M'aime] {$this->getSubjectLabel($validated['subject'])}");
                }
            );
        } catch (\Exception $e) {
            // Log error but don't fail - message is saved in DB
            report($e);
        }

        // Reset form and show success
        $this->reset(['name', 'email', 'subject', 'message']);
        $this->success = true;
    }

    protected function getSubjectLabel(string $key): string
    {
        return match ($key) {
            'adhesion' => 'Question sur l\'adhesion',
            'annuaire' => 'Question sur l\'annuaire',
            'professionnel' => 'Je suis professionnel',
            'autre' => 'Autre',
            default => 'Autre',
        };
    }

    public function render()
    {
        return view('livewire.contact-page')
            ->layout('layouts.public', [
                'title' => 'Contact - Cap Toi M\'aime',
            ]);
    }
}
