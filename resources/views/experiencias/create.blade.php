@extends('layouts.app')

@section('title', 'Agregar Experiencia')

@section('content')
<div class="bg-white rounded-lg shadow p-6 w-full min-h-[80vh]">

    <h2 class="text-2xl font-bold mb-4 text-gray-800">Agregar Experiencia</h2>

    @if($errors->any())
        <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
            Por favor corrige los errores en los campos resaltados.
        </div>
    @endif

    <form action="{{ route('experiencias.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Empresa --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Empresa <span class="text-red-500">*</span></label>
            <input type="text" name="empresa" value="{{ old('empresa') }}"
                   class="w-full px-4 py-2 rounded border @error('empresa') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('empresa')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Cargo --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Cargo <span class="text-red-500">*</span></label>
            <input type="text" name="cargo" value="{{ old('cargo') }}"
                   class="w-full px-4 py-2 rounded border @error('cargo') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('cargo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Fechas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Fecha de inicio --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">
                    Fecha de Inicio <span class="text-red-500">*</span>
                </label>
                <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}"
                    class="w-full px-4 py-2 rounded border 
                            @error('fecha_inicio') border-red-500 @else border-gray-300 @enderror
                            focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('fecha_inicio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Fecha de fin --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Fecha de Fin</label>
                <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}"
                    class="w-full px-4 py-2 rounded border 
                            @error('fecha_fin') border-red-500 @else border-gray-300 @enderror
                            focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('fecha_fin')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">Déjelo vacío si aún trabaja aquí.</p>
            </div>
        </div>

        {{-- Tecnologías (texto libre, separadas por comas) --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Tecnologías <span class="text-red-500">*</span></label>
            <input type="text" name="tecnologias" value="{{ old('tecnologias') }}"
                   placeholder="Ejemplo: PHP, Laravel, MySQL, Vue.js"
                   class="w-full px-4 py-2 rounded border @error('tecnologias') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            <p class="text-gray-500 text-sm mt-1">Escriba varias tecnologías separadas por comas.</p>
            @error('tecnologias')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Descripción --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Descripción</label>
            <textarea name="descripcion" rows="3"
                      class="w-full px-4 py-2 rounded border @error('descripcion') border-red-500 @else border-gray-300 @enderror
                             focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <hr>
        {{-- Botones --}}
        <div class="flex justify-start space-x-2 mt-6">
            <a href="{{ route('experiencias.index') }}" 
               class="px-4 py-1 bg-gray-300 text-gray-800 rounded shadow hover:bg-gray-400 transition">
                Volver
            </a>

            <button type="submit" 
                    class="px-4 py-1 bg-blue-500 text-white rounded shadow hover:bg-blue-600 transition">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection
