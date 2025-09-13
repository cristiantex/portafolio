<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mi Portafolio</title>
        <!-- Font Awesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js" integrity="sha512-6BTOlkauINO65nLhXhthZMtepgJSghyimIalb+crKRPhvhmsCdnIuGcVbR5/aQY2A+260iC1OPy1oCdB6pSSwQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Tailwind --> {{-- @vite('resources/css/app.css') --}}
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        @yield('content')
        @include('layouts.social-floating-bar')
    </body>
</html>