<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactNotification extends Notification
{
    use Queueable;

    public function __construct(public Contact $contact)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nouveau message de contact — OKAMI Sarl')
            ->greeting('Nouveau message reçu !')
            ->line("**Nom :** {$this->contact->nom}")
            ->line("**Email :** {$this->contact->email}")
            ->line("**Téléphone :** {$this->contact->telephone}")
            ->line("**Sujet :** {$this->contact->sujet}")
            ->line("**Message :** {$this->contact->message}")
            ->action('Voir dans l\'administration', url('/'))
            ->salutation('— OKAMI Sarl');
    }
}

