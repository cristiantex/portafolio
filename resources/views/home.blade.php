{{-- resources/views/home.blade.php --}}
@extends('layouts.web')
@section('content')
<div class="antialiased bg-gray-950 text-white">

       <!-- NAVBAR -->
    <header class="bg-gray-950 shadow fixed w-full top-0 z-50 border-b border-gray-800">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-xl font-bold text-blue-600">{{ $perfils[0]->alias}}</h1>
            <nav class="space-x-6 text-gray-300 font-medium">
                <a href="#inicio" class="hover:text-blue-500">Inicio</a>
                <a href="#sobremi" class="hover:text-blue-500">Sobre mí</a>
                <a href="#tecnologias" class="hover:text-blue-500">Tecnologías</a>
                <a href="#experiencia" class="hover:text-blue-500">Experiencia</a>
                <a href="#formacion" class="hover:text-blue-500">Formación</a>
                <a href="#proyectos" class="hover:text-blue-500">Proyectos</a>
                <a href="#contacto" class="hover:text-blue-500">Contacto</a>
            </nav>
        </div>
    </header>
    <main class="pt-24">
        <!-- INICIO -->
        <section id="inicio" class="h-screen flex items-center justify-center bg-gradient-to-r from-gray-950 to-gray-900 text-white">
            <div class="text-center">
                <h2 class="text-4xl md:text-6xl font-bold mb-4">Hola, soy {{ $perfils[0]->nombre}}</h2>
                <p class="text-lg md:text-2xl mb-6 text-gray-300">{{ $perfils[0]->profesion }}</p>
                <a href="#proyectos" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">Ver proyectos</a>
            </div>
        </section>
        
        <!-- SOBRE MÍ -->
        <section id="sobremi" class="bg-gray-950 container mx-auto py-20 px-6">
            <h2 class="text-3xl font-bold mb-6 text-center text-blue-500">Sobre mí</h2>
            <div class="md:flex items-center gap-8">
                <img src="{{ $perfils[0]->foto_perfil }}" alt="{{ $perfils[0]->alias}}" class="rounded-full w-48 h-48 mx-auto md:mx-0 shadow-lg">
                <p class="text-lg leading-relaxed mt-6 md:mt-0 text-gray-300">
                    {{ $perfils[0]->descripcion }}
                </p>
            </div>
        </section>
        
        <!-- FORMACIÓN -->
        <section id="formacion" class="bg-gradient-to-r from-gray-900 to-gray-950 py-20 px-6 text-white">
            <h2 class="text-3xl font-bold mb-12 text-center text-blue-500">Formación</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 container mx-auto">
                @foreach ($formacions as $form)
                    <div class="bg-gray-700 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">{{ $form->institucion }}</h3>
                            <p class="text-gray-300 mb-2">{{ $form->tipo }} : {{ $form->titulo }}</p>
                            <p class="text-sm text-gray-400 mb-2">
                                {{ $form->fecha_inicio }} - {{ $form->fecha_fin ?? 'En curso' }}
                            </p>
                            @if($form->certificado_url)
                                <p class="text-sm text-gray-300">
                                    <a href="{{ $form->certificado_url }}" target="_blank">Ver certificado</a>
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        
        <!-- TECNOLOGÍAS -->
        <section id="tecnologias" class="bg-gray-950 container mx-auto py-20 px-6">
            <h2 class="text-3xl font-bold mb-6 text-blue-500 text-center">Tecnologías</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach ($tecnologias as $tec)
                    <div class="bg-gray-800 p-6 rounded-2xl shadow-lg hover:shadow-xl transition">
                        <h3 class="text-xl font-semibold text-white">{{ $tec->nombre }}</h3>
                        <p class="text-sm text-gray-300">Nivel: {{ $tec->nivel }}</p>
                        <p class="text-sm text-gray-400">Experiencia: {{ $tec->experiencia_anios }} años</p>
                        @if($tec->descripcion)
                            <p class="mt-2 text-gray-300">{{ $tec->descripcion }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>

        <!-- PROYECTOS -->
        <section id="proyectos" class="bg-gradient-to-r from-gray-950 to-gray-900 py-20 px-6 text-white">
            <h2 class="text-3xl font-bold mb-12 text-center text-blue-500">Proyectos</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 container mx-auto">
                @foreach ($proyectos as $proy)
                    <div class="bg-gray-700 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition flex flex-col">
                        <!-- Imagen -->
                        <div class="h-48 w-full overflow-hidden">
                            <img src="{{ $proy->imagen ? asset($proy->imagen) : asset('images/default.png') }}" 
                                alt="{{ $proy->titulo }}" 
                                class="object-cover w-full h-full">
                        </div>

                        <!-- Contenido -->
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold mb-2">{{ $proy->titulo }}</h3>
                            <p class="text-gray-300 mb-4 flex-grow">{{ $proy->descripcion }}</p>

                            <!-- Botón Ver más -->
                            @if($proy->url)
                                <div class="mb-4">
                                    <a href="{{ $proy->url }}" target="_blank" 
                                    class="mt-auto inline-block text-blue-500 font-semibold hover:underline">
                                        Ver github
                                    </a>
                                </div>
                            @endif

                            <!-- Tecnologías -->
                            @if($proy->tecnologias)
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-400 mb-2">Tecnologías:</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(explode(',', $proy->tecnologias) as $tec)
                                            <span class="bg-gray-600 text-gray-200 text-xs px-3 py-1 rounded-full">
                                                {{ trim($tec) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- EXPERIENCIA -->
        <section id="experiencia" class="bg-gray-950 container mx-auto py-20 px-6">
            <h2 class="text-3xl font-bold mb-6 text-blue-500 text-center">Experiencia</h2>
            <div class="space-y-6">
                @foreach ($experiencias as $exp)
                    <div class="bg-gray-800 p-6 rounded-2xl shadow-md">
                        <!-- Cabecera compacta -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            <h3 class="text-xl font-semibold text-white">{{ $exp->empresa }}</h3>
                            <p class="text-sm text-gray-400 mt-1 sm:mt-0">
                                {{ $exp->fecha_inicio }} – {{ $exp->fecha_fin ?? 'Actualidad' }}
                            </p>
                        </div>
                        <p class="text-md text-blue-400 font-medium">{{ $exp->cargo }}</p>

                        <!-- Descripción -->
                        @if($exp->descripcion)
                            <p class="mt-3 text-gray-300 leading-relaxed">{{ $exp->descripcion }}</p>
                        @endif

                        <!-- Logros -->
                        @if($exp->logros)
                            <div class="mt-4">
                                <h4 class="text-sm font-semibold text-gray-200 mb-2">Logros:</h4>
                                <ul class="list-disc list-inside text-gray-400 space-y-1">
                                    @foreach (explode(';', $exp->logros) as $logro)
                                        <li>{{ trim($logro) }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Tecnologías -->
                        @if(!empty($exp->tecnologias))
                            <div class="mt-4">
                                <h4 class="text-sm font-semibold text-gray-300 mb-2">Tecnologías:</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach (explode(',', $exp->tecnologias) as $tec)
                                        <span class="bg-gray-700 text-gray-200 text-xs px-3 py-1 rounded-full">
                                            {{ trim($tec) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
        
        <!-- CONTACTO -->
        <section id="contacto" class="bg-gradient-to-r from-gray-900 to-gray-950 mx-auto py-20 px-6">
            <h2 class="text-3xl font-bold mb-6 text-blue-500 text-center">Contacto</h2>
            <p class="text-center mb-8 text-gray-300">¿Quieres trabajar conmigo? Escríbeme o conéctate por mis redes:</p>

            <!-- Formulario -->
            <form action="#" method="POST" class="max-w-xl mx-auto bg-gray-800 p-8 rounded-2xl shadow-lg space-y-6 border border-gray-700 mb-12">
                <input 
                    type="text" 
                    placeholder="Tu nombre" 
                    class="w-full p-3 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-950 placeholder-gray-400" 
                    required
                >
                <input 
                    type="email" 
                    placeholder="Tu correo" 
                    class="w-full p-3 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-950 placeholder-gray-400" 
                    required
                >
                <textarea 
                    placeholder="Tu mensaje" 
                    rows="5" 
                    class="w-full p-3 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-950 placeholder-gray-400" 
                    required
                ></textarea>
                <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">Enviar</button>
            </form>
        </section>
    </main>
    
    <!-- FOOTER -->
    <footer class="bg-gray-950 text-white py-6 text-center">
        <div class="flex justify-center space-x-6 mb-4">
            <a href="mailto:{{ $perfils[0]->email }}" class="hover:text-blue-500" title="Email">
                <i class="fas fa-envelope text-xl"></i>
            </a>
            <a href="tel:{{ $perfils[0]->telefono }}" class="hover:text-blue-500" title="Teléfono">
                <i class="fas fa-phone text-xl"></i>
            </a>
            <a href="{{ $perfils[0]->linkedin }}" target="_blank" class="hover:text-blue-500" title="LinkedIn">
                <i class="fab fa-linkedin text-xl"></i>
            </a>
            <a href="{{ $perfils[0]->github }}" target="_blank" class="hover:text-blue-500" title="GitHub">
                <i class="fab fa-github text-xl"></i>
            </a>
        </div>
        <p>© {{ date('Y') }} {{ $perfils[0]->alias}} - Todos los derechos reservados.</p>
    </footer>
</div>
@endsection