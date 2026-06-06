@extends('admin.layout')
@section('content')

<h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-8">👥 Gestion des utilisateurs</h1>

<div class="bg-white dark:bg-gray-800 rounded-2xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
            <tr>
                <th class="px-6 py-3 text-left">Utilisateur</th>
                <th class="px-6 py-3 text-left">Email</th>
                <th class="px-6 py-3 text-left">Rôle</th>
                <th class="px-6 py-3 text-left">Inscrit le</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
            @forelse($users as $user)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-orange-400 to-yellow-400
                                    flex items-center justify-center text-white font-bold text-sm">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-medium text-gray-800 dark:text-white">{{ $user->name }}</div>
                            @if($user->isNamedAdmin())
                            <div class="text-xs text-orange-500 font-medium">Administrateur nommé</div>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-500">{{ $user->email }}</td>
                <td class="px-6 py-4">
                    @if($user->isNamedAdmin())
                        <span class="bg-orange-100 text-orange-700 text-xs px-2 py-1 rounded-full font-semibold">
                            ⚙️ Admin nommé
                        </span>
                    @else
                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">
                            👤 Utilisateur
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 text-gray-400 text-xs">
                    {{ $user->created_at->format('d/m/Y') }}
                </td>
                <td class="px-6 py-4">
                    @if($user->isNamedAdmin())
                        <form method="POST" action="{{ route('admin.users.demote', $user) }}">
                            @csrf
                            <button class="bg-red-100 text-red-700 px-3 py-1 rounded-lg text-xs hover:bg-red-200 transition">
                                ↓ Rétrograder
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.users.promote', $user) }}">
                            @csrf
                            <button class="bg-orange-100 text-orange-700 px-3 py-1 rounded-lg text-xs hover:bg-orange-200 transition">
                                ↑ Nommer admin
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                    Aucun utilisateur pour l'instant.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection