@extends('layouts.app')
@section('title', 'Experiencias')
@section('content')
<div class="bg-white rounded-lg shadow p-6 w-full min-h-[80vh]">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Experiencias</h2>
        <a href="{{ route('experiencias.create') }}" class="px-2 py-1 bg-blue-500 text-white rounded shadow hover:bg-blue-600 transition">
            <i class="fa-solid fa-plus"></i> Agregar
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-2 rounded bg-green-100 text-green-800 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-gray-300" id="table_experiencias">
        <thead>
            <tr class="bg-gray-100 text-gray-700">
                <th class="px-4 py-2 border">Empresa</th>
                <th class="px-4 py-2 border">Cargo</th>
                <th class="px-4 py-2 border">Fecha Inicio</th>
                <th class="px-4 py-2 border">Fecha Fin</th>
                <th class="px-4 py-2 border">Descripción</th>
                <th class="px-4 py-2 border">Tecnologías</th>
                <th class="px-4 py-2 border">Logros</th>
                <th class="px-4 py-2 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($experiencias as $e)
            <tr class="text-gray-700">
                <td class="border px-4 py-2">{{ $e->empresa }}</td>
                <td class="border px-4 py-2">{{ $e->cargo }}</td>
                <td class="border px-4 py-2">{{ $e->fecha_inicio }}</td>
                <td class="border px-4 py-2">{{ $e->fecha_fin ?? '-' }}</td>
                <td class="border px-4 py-2">{{ $e->descripcion ?? '-' }}</td>
                <td class="border px-4 py-2">
                    @if(is_array($e->tecnologias))
                        {{ implode(', ', $e->tecnologias) }}
                    @else
                        {{ $e->tecnologias }}
                    @endif
                </td>
                <td class="border px-4 py-2">{{ $e->logros ?? '-' }}</td>
                <td class="border px-4 py-2 text-center">
                    <div class="flex justify-center space-x-2">
                        {{-- Botón Editar --}}
                        <a href="{{ route('experiencias.edit', $e) }}" 
                        class="inline-flex items-center justify-center w-7 h-7 bg-yellow-400 text-white rounded hover:bg-yellow-500" 
                        title="Editar">
                            <i class="fa-solid fa-pen text-sm"></i>
                        </a>

                        {{-- Botón Eliminar --}}
                        <button type="button"
                                class="inline-flex items-center justify-center w-7 h-7 bg-red-500 text-white rounded hover:bg-red-600 btn-delete"
                                data-id="{{ $e->id }}"
                                title="Eliminar">
                            <i class="fa-solid fa-trash text-sm"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Modal Global para eliminar --}}
<div id="deleteModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 text-center">
    <div class="bg-white rounded-lg shadow-lg p-4 w-80">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">
            ¿Eliminar esta experiencia?
        </h2>
        <p class="text-sm text-gray-600 mb-6">
            Esta acción no se puede deshacer.
        </p>
        <div class="flex justify-center space-x-2">
            <button onclick="closeModal()" 
                    class="px-2 py-1 bg-gray-300 rounded hover:bg-gray-400">
                Cancelar
            </button>
            <form id="deleteForm" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Eliminar</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const table = document.querySelector("#table_experiencias");
        if (table) {
            new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: true,
                labels: {
                    placeholder: "Buscar...",
                    perPage: "registros por página",
                    noRows: "No hay registros para mostrar",
                    info: "Mostrando {start} a {end} de {rows} registros"
                }
            });
        }

        // Modal delete
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const routeBase = "{{ route('experiencias.destroy', 0) }}";

        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function () {
                let id = this.dataset.id;
                form.action = routeBase.replace(/0$/, id);
                modal.classList.remove('hidden');
            });
        });
    });

    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>

@endsection