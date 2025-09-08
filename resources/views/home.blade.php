{{-- resources/views/home.blade.php --}}
@extends('layouts.web')

@section('content')
<div class="antialiased bg-gray-900 text-white">

    <!-- NAVBAR -->
    <header class="bg-white shadow fixed w-full top-0 z-50"> 
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-xl font-bold text-blue-600">{{ $perfils[0]->alias}}</h1>
            <nav class="space-x-6 text-gray-700 font-medium">
                <a href="#inicio" class="hover:text-blue-600">Inicio</a>
                <a href="#sobremi" class="hover:text-blue-600">Sobre mí</a>
                <a href="#tecnologias" class="hover:text-blue-600">Tecnologías</a>
                <a href="#experiencia" class="hover:text-blue-600">Experiencia</a>
                <a href="#formacion" class="hover:text-blue-600">Formación</a>
                <a href="#proyectos" class="hover:text-blue-600">Proyectos</a>
                <a href="#contacto" class="hover:text-blue-600">Contacto</a>
            </nav>
        </div>
    </header>

    <main class="pt-22">
        <!-- INICIO -->
        <section id="inicio" class="h-screen flex items-center justify-center bg-gradient-to-r from-gray-600 to-indigo-700 text-white">
            <div class="text-center">
                <h2 class="text-4xl md:text-6xl font-bold mb-4">Hola, soy {{ $perfils[0]->nombre}}</h2>
                <p class="text-lg md:text-2xl mb-6">Ingeniero en Desarrollo de Software | Web & Microservicios</p>
                <a href="#proyectos" class="px-6 py-3 bg-white text-blue-700 font-semibold rounded-lg shadow hover:bg-gray-100 transition">Ver proyectos</a>
            </div>
        </section>

        <!-- SOBRE MÍ -->
        <section id="sobremi" class="container mx-auto py-20 px-6">
            <h2 class="text-3xl font-bold mb-6 text-center text-blue-500">Sobre mí</h2>
            <div class="md:flex items-center gap-8">
                <img src="{{ $perfils[0]->foto_perfil }}" alt="{{ $perfils[0]->alias}}" class="rounded-full w-48 h-48 mx-auto md:mx-0 shadow-lg">
                <p class="text-lg leading-relaxed mt-6 md:mt-0 text-gray-300">
                    {{ $perfils[0]->descripcion }}
                </p>
            </div>
        </section>

        <!-- FORMACIÓN -->
        <section id="formacion" class="bg-gray-100 py-20 px-6 text-gray-900">
            <h2 class="text-3xl font-bold mb-12 text-center text-blue-600">Formación</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 container mx-auto">
                @foreach ($formacions as $form)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">{{ $form->institucion }}</h3>
                            <p class="text-gray-700 mb-2">{{ $form->titulo }}</p>
                            <p class="text-sm text-gray-500">
                                {{ $form->fecha_inicio }} - {{ $form->fecha_fin ?? 'En curso' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- TECNOLOGÍAS -->
        <section id="tecnologias" class="container mx-auto py-20 px-6">
            <h2 class="text-3xl font-bold mb-6 text-blue-500 text-center">Tecnologías</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach ($tecnologias as $tec)
                    <div class="bg-gray-800 p-6 rounded-2xl shadow-lg hover:shadow-xl transition">
                        <h3 class="text-xl font-semibold text-white">{{ $tec->nombre }}</h3>
                        <p class="text-sm text-gray-300">Nivel: {{ $tec->nivel }}</p>
                        <p class="text-sm text-gray-400">Experiencia: {{ $tec->experiencia }} años</p>
                        @if($tec->descripcion)
                            <p class="mt-2 text-gray-300">{{ $tec->descripcion }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>

        <!-- PROYECTOS -->
        <section id="proyectos" class="bg-gray-100 py-20 px-6 text-gray-900">
            <h2 class="text-3xl font-bold mb-12 text-center text-blue-600">Proyectos</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 container mx-auto">
                @foreach ($proyectos as $proy)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">{{ $proy->nombre }}</h3>
                            <p class="text-gray-600 mb-4">{{ $proy->descripcion }}</p>
                            @if($proy->url)
                                <a href="{{ $proy->url }}" target="_blank" class="text-blue-600 font-semibold hover:underline">Ver más →</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- EXPERIENCIA -->
        <section id="experiencia" class="container mx-auto py-20 px-6">
            <h2 class="text-3xl font-bold mb-6 text-blue-500 text-center">Experiencia</h2>
            <div class="space-y-6">
                @foreach ($experiencias as $exp)
                    <div class="bg-gray-800 p-6 rounded-2xl shadow-md">
                        <h3 class="text-xl font-semibold text-white">{{ $exp->lugar }}</h3>
                        <p class="text-sm text-gray-400">{{ $exp->fecha_inicio }} - {{ $exp->fecha_fin ?? 'Actualidad' }}</p>
                        <p class="mt-2 text-gray-300">{{ $exp->labor }}</p>
                        @if($exp->logros)
                            <ul class="list-disc list-inside mt-2 text-gray-400">
                                @foreach (explode(';', $exp->logros) as $logro)
                                    <li>{{ $logro }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
        
        <!-- CONTACTO -->
        <section id="contacto" class="container mx-auto py-20 px-6">
            <h2 class="text-3xl font-bold mb-6 text-blue-500 text-center">Contacto</h2>
            <p class="text-center mb-8 text-gray-300">¿Quieres trabajar conmigo? Escríbeme:</p>
            <form action="#" method="POST" class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-lg space-y-6">
                <input type="text" placeholder="Tu nombre" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 text-gray-600" required>
                <input type="email" placeholder="Tu correo" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 text-gray-600" required>
                <textarea placeholder="Tu mensaje" rows="5" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 text-gray-600" required></textarea>
                <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">Enviar</button>
            </form>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white py-6 text-center">
        <p>© 2025 {{ $perfils[0]->alias}} - Todos los derechos reservados.</p>
    </footer>
</div>
@endsection