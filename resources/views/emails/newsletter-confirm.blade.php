@component('mail::message')
# Bienvenue sur Solar Access ! ☀️

Vous êtes maintenant abonné à la newsletter **Solar Access — Énergie Pour le Bénin**.

Voici ce que vous recevrez concrètement :

**📰 Chaque semaine :**
- Les nouveaux articles publiés sur le blog
- Les actualités du secteur énergétique au Bénin

**🔔 En temps réel :**
- Alertes sur les nouvelles subventions disponibles
- Annonces des programmes d'aide gouvernementaux et ONG

**💡 Régulièrement :**
- Guides pratiques pour choisir votre kit solaire
- Conseils de maintenance et d'optimisation
- Témoignages de Béninois ayant adopté le solaire
- Offres PAYG (paiement échelonné) disponibles dans votre région

@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
Lire les derniers articles
@endcomponent

---

Pour vous désabonner à tout moment, cliquez ici :

@component('mail::button', ['url' => $unsubscribeUrl, 'color' => 'red'])
Me désabonner
@endcomponent

Cordialement,
**L'équipe Solar Access**
*Énergie Pour le Bénin — EPAC / GIT 2025-2026*
@endcomponent