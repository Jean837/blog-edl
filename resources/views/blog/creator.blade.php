@extends('blog.layout')
@section('title', 'À propos du créateur')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-16">

    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl overflow-hidden">

        {{-- Bannière --}}
        <div class="bg-gradient-to-br from-orange-500 via-yellow-500 to-green-500 h-32"></div>

        {{-- Profil --}}
        <div class="px-8 pb-8">
            <div class="-mt-12 mb-6">
                <div class="w-24 h-24 rounded-2xl bg-white shadow-lg flex items-center justify-center text-4xl border-4 border-white">
                    👨‍💻
                </div>
            </div>

            <h1 class="text-2xl font-extrabold text-gray-800 dark:text-white mb-1">
                GNACADJA Jean De Dieu
            </h1>
            <p class="text-orange-500 font-semibold mb-4">
                Développeur Web — EPAC / GIT 2025-2026
            </p>

            <p class="text-gray-600 dark:text-gray-300 leading-relaxed mb-6">
                Étudiant en Génie Informatique et Télécommunications à l'École Polytechnique
                d'Abomey-Calavi (EPAC), passionné par le développement web et les technologies
                au service du développement durable en Afrique.
            </p>

            <p class="text-gray-600 dark:text-gray-300 leading-relaxed mb-8">
                <strong>Solar Access</strong> est un projet académique développé dans le cadre
                du cours de développement web. Il vise à démocratiser l'accès à l'information
                sur les solutions énergétiques solaires au Bénin, en s'appuyant sur les
                technologies modernes comme Laravel, MySQL et Tailwind CSS.
            </p>

            {{-- Stack --}}
            <h2 class="font-bold text-gray-800 dark:text-white mb-3">🛠️ Technologies utilisées</h2>
            <div class="flex flex-wrap gap-2 mb-8">
                @foreach(['Laravel 11', 'PHP 8.4', 'MySQL', 'Tailwind CSS', 'Railway', 'GitHub'] as $tech)
                <span class="bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400
                             px-3 py-1 rounded-full text-sm font-medium">
                    {{ $tech }}
                </span>
                @endforeach
            </div>

            {{-- Membres du groupe --}}
            <h2 class="font-bold text-gray-800 dark:text-white mb-3">👥 Groupe 1 — EPAC GIT</h2>
            <div class="grid grid-cols-2 gap-3">
                @foreach([
                    'ADIMI Prince',
                    'ADJANOHUN Mathys de Marie',
                    'FALOLA Grâce',
                    'GBABLI MATHIEU Nahine',
                    'GNACADJA Jean De Dieu',
                    'TEVI Lambert',
                ] as $membre)
                <div class="flex items-center gap-2 bg-gray-50 dark:bg-gray-700 rounded-xl px-3 py-2">
                    <div class="w-7 h-7 rounded-full bg-gradient-to-br from-orange-400 to-yellow-400
                                flex items-center justify-center text-white text-xs font-bold">
                        {{ strtoupper(substr($membre, 0, 1)) }}
                    </div>
                    <span class="text-sm text-gray-700 dark:text-gray-200">{{ $membre }}</span>
                </div>
                @endforeach
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700">
                <a href="{{ route('blog.index') }}"
                   class="inline-flex items-center gap-2 bg-orange-500 text-white px-6 py-3 rounded-full font-semibold hover:bg-orange-600 transition">
                    ← Retour au blog
                </a>
            </div>
        </div>
    </div>
</div>
@endsection