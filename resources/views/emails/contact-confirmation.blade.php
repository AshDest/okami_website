<x-mail::message>
# Merci de nous avoir contacté, {{ $contact->nom }} !

Nous avons bien reçu votre message et nous vous répondrons dans les plus brefs délais.

**Récapitulatif de votre demande :**

- **Sujet :** {{ $contact->sujet }}
- **Message :** {{ $contact->message }}

Notre équipe traite généralement les demandes sous 24 à 48 heures ouvrables.

<x-mail::button :url="url('/')">
Visiter notre site
</x-mail::button>

Cordialement,<br>
L'équipe **OKAMI Sarl**
</x-mail::message>

