<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    {{-- @vite('resources/css/app.css') {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-white mb-6">Acceder</h2>

        @if($errors->any())
            <div class="bg-red-600 text-white p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-gray-300 mb-1">Usuario</label>
                <input type="text" name="user" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-gray-300 mb-1">Contraseña</label>
                <input type="password" name="password" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                Ingresar
            </button>
        </form>
    </div>

</body>
</html>
