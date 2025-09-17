@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-4">Bienvenido/a {{ $alias }} 🚀</h2>
    <p class="text-gray-700 mb-6">Este es tu panel principal. Aquí podrás visualizar estadísticas.</p>

    {{-- Tarjetas de estadísticas con gradiente --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

        <!-- Tecnologías -->
        <div class="flex items-center bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition">
            <div class="text-5xl mr-4">
                <i class="fa-solid fa-code"></i>
            </div>
            <div class="flex flex-col text-left">
                <h3 class="text-3xl font-bold">{{ $tecnologias }}</h3>
                <p class="text-lg">Tecnologías</p>
            </div>
        </div>

        <!-- Formación -->
        <div class="flex items-center bg-gradient-to-r from-green-500 to-emerald-700 text-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition">
            <div class="text-5xl mr-4">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div class="flex flex-col text-left">
                <h3 class="text-3xl font-bold">{{ $formacions }}</h3>
                <p class="text-lg">Formación</p>
            </div>
        </div>

        <!-- Experiencias -->
        <div class="flex items-center bg-gradient-to-r from-purple-500 to-indigo-700 text-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition">
            <div class="text-5xl mr-4">
                <i class="fa-solid fa-briefcase"></i>
            </div>
            <div class="flex flex-col text-left">
                <h3 class="text-3xl font-bold">{{ $experiencias }}</h3>
                <p class="text-lg">Experiencias</p>
            </div>
        </div>

        <!-- Proyectos -->
        <div class="flex items-center bg-gradient-to-r from-pink-500 to-rose-700 text-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition">
            <div class="text-5xl mr-4">
                <i class="fa-solid fa-diagram-project"></i>
            </div>
            <div class="flex flex-col text-left">
                <h3 class="text-3xl font-bold">{{ $proyectos }}</h3>
                <p class="text-lg">Proyectos</p>
            </div>
        </div>
    </div>
</div>

{{-- Nueva sección de burbujas --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

    <!-- Burbujas de notificaciones -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-bold mb-4 text-gray-800">Pendientes 📌</h3>
        <div class="space-y-4">

            <div class="flex items-start space-x-3 bg-gray-100 rounded-lg p-3">
                <i class="fa-solid fa-diagram-project text-pink-500 text-xl mt-1"></i>
                <p class="text-gray-700">Tienes <strong>{{ $proyectosPendientes ?? 0 }}</strong> proyectos pendientes de publicar.</p>
            </div>

            @if(empty($perfil->email))
                <div class="flex items-start space-x-3 bg-gray-100 rounded-lg p-3">
                    <i class="fa-solid fa-envelope text-blue-500 text-xl mt-1"></i>
                    <p class="text-gray-700">Correo pendiente de publicar.</p>
                </div>
            @endif

            @if(empty($perfil->telefono))
                <div class="flex items-start space-x-3 bg-gray-100 rounded-lg p-3">
                    <i class="fa-solid fa-phone text-green-500 text-xl mt-1"></i>
                    <p class="text-gray-700">Teléfono pendiente de agregar.</p>
                </div>
            @endif

            @if(empty($perfil->linkedin))
                <div class="flex items-start space-x-3 bg-gray-100 rounded-lg p-3">
                    <i class="fa-brands fa-linkedin text-blue-700 text-xl mt-1"></i>
                    <p class="text-gray-700">LinkedIn pendiente de agregar.</p>
                </div>
            @endif

            @if(empty($perfil->github))
                <div class="flex items-start space-x-3 bg-gray-100 rounded-lg p-3">
                    <i class="fa-brands fa-github text-gray-800 text-xl mt-1"></i>
                    <p class="text-gray-700">GitHub pendiente de agregar.</p>
                </div>
            @endif

            @if(empty($perfil->foto_perfil))
                <div class="flex items-start space-x-3 bg-gray-100 rounded-lg p-3">
                    <i class="fa-solid fa-image text-purple-500 text-xl mt-1"></i>
                    <p class="text-gray-700">Imagen de perfil pendiente de subir.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Gráfico simple -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-bold mb-4 text-gray-800">Actividad 📊</h3>
        <canvas id="activityChart" height="150"></canvas>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('activityChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Proyectos', 'Experiencias', 'Formación', 'Tecnologías'],
            datasets: [{
                label: 'Cantidad',
                data: [{{ $proyectos }}, {{ $experiencias }}, {{ $formacions }}, {{ $tecnologias }}],
                backgroundColor: [
                    '#ec4899', // rosa
                    '#8b5cf6', // púrpura
                    '#10b981', // verde
                    '#3b82f6'  // azul
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#374151',
                        font: { size: 14 }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#374151' }
                },
                x: {
                    ticks: { color: '#374151' }
                }
            }
        }
    });
</script>
@endsection