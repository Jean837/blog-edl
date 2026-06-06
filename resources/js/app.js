

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// ── Dark Mode ──────────────────────────────────────────────
window.toggleDarkMode = function () {
    const html = document.documentElement;
    if (html.classList.contains('dark')) {
        html.classList.remove('dark');
        localStorage.theme = 'light';
    } else {
        html.classList.add('dark');
        localStorage.theme = 'dark';
    }
    updateDarkModeIcon();
}

function updateDarkModeIcon() {
    const btn = document.getElementById('dark-mode-btn');
    if (!btn) return;
    btn.textContent = document.documentElement.classList.contains('dark') ? '☀️' : '🌙';
}

document.addEventListener('DOMContentLoaded', updateDarkModeIcon);

// Appliquer le thème sauvegardé dès le chargement
if (localStorage.theme === 'dark' ||
   (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
  document.documentElement.classList.add('dark');
} else {
  html.classList.remove('dark');
}

// Bouton toggle
window.toggleDarkMode = function () {
  if (html.classList.contains('dark')) {
    html.classList.remove('dark');
    localStorage.theme = 'light';
  } else {
    html.classList.add('dark');
    localStorage.theme = 'dark';
  }
  updateDarkModeIcon();
}

function updateDarkModeIcon() {
  const btn = document.getElementById('dark-mode-btn');
  if (!btn) return;
  btn.textContent = html.classList.contains('dark') ? '☀️' : '🌙';
}

document.addEventListener('DOMContentLoaded', updateDarkModeIcon);
