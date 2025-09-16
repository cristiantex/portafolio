<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    {{-- @vite('resources/css/app.css') {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine js -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <!-- font-awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js" integrity="sha512-6BTOlkauINO65nLhXhthZMtepgJSghyimIalb+crKRPhvhmsCdnIuGcVbR5/aQY2A+260iC1OPy1oCdB6pSSwQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Simple-DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" defer></script>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col" x-data="{ sidebarOpen: false }">
    <!-- Navbar -->
    <nav class="bg-gray-800 text-white px-6 py-4 flex justify-between items-center">
        <!-- Botón toggle en móvil -->
        <button class="md:hidden focus:outline-none" @click="sidebarOpen = !sidebarOpen">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" 
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <h1 class="text-xl font-bold">Mi Dashboard</h1>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-600 hover:bg-red-700 px-2 py-1 rounded">
                <i class="fa-solid fa-xmark"></i> Cerrar sesión
            </button>
        </form>
    </nav>

    <div class="flex flex-1">
        <!-- Sidebar en escritorio -->
        <aside class="w-64 bg-gray-900 text-gray-200 hidden md:block">
            <div class="p-6 text-lg font-semibold border-b border-gray-700">
                Menú
            </div>
            <ul class="space-y-2 p-4">
                <li>
                    <a href="{{ route('welcome') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Inicio</a>
                </li>
                <li>
                    <a href="{{ route('perfil.edit') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Perfil</a>
                </li>
                <li>
                    <a href="{{ route('formacion.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Formación</a>
                </li>
                <li>
                    <a href="{{ route('tecnologias.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Tecnologías</a>
                </li>
                <li>
                    <a href="{{ route('experiencias.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Experiencias</a>
                </li>
                <li>
                    <a href="{{ route('proyectos.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Proyectos</a>
                </li>
            </ul>
        </aside>

        <!-- Sidebar móvil -->
        <div class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden" x-show="sidebarOpen" @click="sidebarOpen = false"></div>
        <aside class="fixed inset-y-0 left-0 w-64 bg-gray-900 text-gray-200 z-50 transform -translate-x-full transition-transform duration-300 md:hidden"
               :class="{ 'translate-x-0': sidebarOpen }">
            <div class="p-6 text-lg font-semibold border-b border-gray-700 flex justify-between items-center">
                Menú <button class="text-gray-400 hover:text-white" @click="sidebarOpen = false">&times;</button>
            </div>
            <ul class="space-y-2 p-4">
                <li>
                    <a href="{{ route('welcome') }}" class="block px-4 py-2 rounded hover:bg-gray-700" @click="sidebarOpen = false">
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="{{ route('perfil.edit') }}" class="block px-4 py-2 rounded hover:bg-gray-700" @click="sidebarOpen = false">
                        Perfil
                    </a>
                </li>
                <li>
                    <a href="{{ route('formacion.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700" @click="sidebarOpen = false">
                        Formación
                    </a>
                </li>
                <li>
                    <a href="{{ route('tecnologias.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700" @click="sidebarOpen = false">
                        Tecnologías
                    </a>
                </li>
                <li>
                    <a href="{{ route('experiencias.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700" @click="sidebarOpen = false">
                        Experiencias
                    </a>
                </li>
                <li>
                    <a href="{{ route('proyectos.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700" @click="sidebarOpen = false">
                        Proyectos
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Contenido principal -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 text-center py-4">
        © {{ date('Y') }} - Mi Dashboard. Todos los derechos reservados.
    </footer>
</body>
</html>