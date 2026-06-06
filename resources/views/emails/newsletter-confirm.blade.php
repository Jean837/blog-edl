@component('mail::message')
# 📡 Bienvenue sur Blog Télécom !

Vous êtes maintenant abonné à notre newsletter.

Vous recevrez les derniers articles sur la **5G, la fibre, le satellite, l'IoT** et bien plus encore.

@component('mail::button', ['url' => $unsubscribeUrl, 'color' => 'red'])
Me désabonner
@endcomponent

Cordialement,
**L'équipe Blog Télécom**
@endcomponent