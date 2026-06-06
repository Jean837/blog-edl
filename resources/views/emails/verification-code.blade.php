@component('mail::message')
# Bienvenue sur Blog Télécom, {{ $userName }} ! 👋

Merci de vous être inscrit. Voici votre code de confirmation :

@component('mail::panel')
# {{ $code }}
@endcomponent

Ce code est valable **15 minutes**.

Entrez ce code sur la page de vérification pour activer votre compte.

@component('mail::button', ['url' => config('app.url').'/verify-email'])
Vérifier mon compte
@endcomponent

Si vous n'avez pas créé de compte, ignorez cet email.

Cordialement,
**L'équipe Blog Télécom**
@endcomponent