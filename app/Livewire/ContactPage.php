<?php

namespace App\Livewire;

use App\Livewire\Concerns\WithPageContent;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactPage extends Component
{
    use WithPageContent;

    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $message = '';
    public bool $success = false;

    public function mount(): void
    {
        $this->loadPageContent('contact');
    }

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
        // Build content structure compatible with template
        $content = $this->pageContent;

        // Ensure hero section has required fields
        if (!isset($content['hero'])) {
            $content['hero'] = [];
        }
        $content['hero'] = array_merge([
            'title' => 'Contactez-nous',
            'subtitle' => 'Une question ? Nous sommes là pour vous aider.',
        ], $content['hero']);

        // Map new CMS structure to template expectations
        if (!isset($content['form_section'])) {
            $content['form_section'] = [
                'show' => true,
                'title' => 'Envoyez-nous un message',
                'success_message' => $this->getContent('form.success_message', 'Merci pour votre message. Nous vous répondrons dans les plus brefs délais.'),
            ];
        }

        if (!isset($content['info_section'])) {
            $content['info_section'] = [
                'website' => $this->getContent('info.website_url', 'www.captoimaime.ch'),
                'website_title' => 'Site principal',
                'website_description' => $this->getContent('info.website_text', 'Visitez le site de l\'association Cap Toi M\'aime'),
            ];
        }

        return view('livewire.contact-page', [
            'content' => $content,
        ])->layout('layouts.public', [
            'title' => $this->getMeta('title', 'Contact - Cap Toi M\'aime'),
        ]);
    }
}
