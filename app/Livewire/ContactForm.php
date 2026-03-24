<?php

namespace App\Livewire;

use App\Mail\ContactConfirmation;
use App\Models\Contact;
use App\Models\User;
use App\Notifications\NewContactNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class ContactForm extends Component
{
    public string $nom = '';
    public string $email = '';
    public string $telephone = '';
    public string $sujet = '';
    public string $message = '';
    public bool $sent = false;

    protected function rules(): array
    {
        return [
            'nom' => 'required|string|min:2|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|min:8|max:20',
            'sujet' => 'required|string|in:Propriétaire,Motard,Partenariat,Réclamation,Autre',
            'message' => 'required|string|min:10|max:5000',
        ];
    }

    protected function messages(): array
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.min' => 'Le nom doit contenir au moins 2 caractères.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'Veuillez entrer un email valide.',
            'telephone.required' => 'Le téléphone est obligatoire.',
            'telephone.min' => 'Le numéro doit contenir au moins 8 chiffres.',
            'sujet.required' => 'Veuillez sélectionner un sujet.',
            'sujet.in' => 'Le sujet sélectionné est invalide.',
            'message.required' => 'Le message est obligatoire.',
            'message.min' => 'Le message doit contenir au moins 10 caractères.',
        ];
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function submit(): void
    {
        $validated = $this->validate();

        $contact = Contact::create($validated);

        // Envoyer notification à l'admin
        try {
            Notification::route('mail', config('mail.from.address', 'contact@okamisarl.org'))
                ->notify(new NewContactNotification($contact));

            // Envoyer confirmation au visiteur
            Mail::to($contact->email)->send(new ContactConfirmation($contact));
        } catch (\Exception $e) {
            // Log l'erreur mais ne pas bloquer l'utilisateur
            logger()->error('Erreur envoi email contact: ' . $e->getMessage());
        }

        $this->reset(['nom', 'email', 'telephone', 'sujet', 'message']);
        $this->sent = true;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}

