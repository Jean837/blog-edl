<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification Email — Blog Télécom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { darkMode: 'class' }</script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md w-full text-center">
        <div class="text-6xl mb-4">📧</div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Vérifiez votre email</h1>
        <p class="text-gray-500 mb-6">
            Un code à 6 chiffres a été envoyé à <strong>{{ Auth::user()->email }}</strong>
        </p>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('verify.email') }}">
            @csrf
            <div class="flex gap-2 justify-center mb-6">
                <input type="text" name="code" maxlength="6"
                    class="w-48 text-center text-3xl font-bold tracking-widest border-2 border-gray-300 rounded-xl p-3 focus:border-blue-500 focus:outline-none"
                    placeholder="000000" autofocus>
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
                ✅ Confirmer mon compte
            </button>
        </form>

        <form method="POST" action="{{ route('verify.email.resend') }}" class="mt-4">
            @csrf
            <button type="submit" class="text-blue-600 hover:underline text-sm">
                🔄 Renvoyer un nouveau code
            </button>
        </form>
    </div>
</body>
</html>