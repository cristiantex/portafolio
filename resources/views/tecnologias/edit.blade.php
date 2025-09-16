@extends('layouts.app')

@section('title', 'Editar Tecnología')

@section('content')
<div class="bg-white rounded-lg shadow p-6 w-full min-h-[80vh]">

    <h2 class="text-2xl font-bold mb-4 text-gray-800">Editar Tecnología</h2>

    @if($errors->any())
        <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
            Por favor corrige los errores en los campos resaltados.
        </div>
    @endif

    <form action="{{ route('tecnologias.update', $tecnologia->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Nombre <span class="text-red-500">*</span></label>
            <input type="text" name="nombre"
                   value="{{ old('nombre', $tecnologia->nombre) }}"
                   class="w-full px-4 py-2 rounded border @error('nombre') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('nombre')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nivel --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Nivel <span class="text-red-500">*</span></label>
            <select name="nivel" 
                    class="w-full px-4 py-2 rounded border @error('nivel') border-red-500 @else border-gray-300 @enderror
                           focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <option value="">Seleccione un nivel</option>
                <option value="Básico" {{ old('nivel', $tecnologia->nivel) == 'Básico' ? 'selected' : '' }}>Básico</option>
                <option value="Intermedio" {{ old('nivel', $tecnologia->nivel) == 'Intermedio' ? 'selected' : '' }}>Intermedio</option>
                <option value="Avanzado" {{ old('nivel', $tecnologia->nivel) == 'Avanzado' ? 'selected' : '' }}>Avanzado</option>
                <option value="Experto" {{ old('nivel', $tecnologia->nivel) == 'Experto' ? 'selected' : '' }}>Experto</option>
            </select>
            @error('nivel')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Años de experiencia --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Años de Experiencia</label>
            <input type="number" name="experiencia_anios" min="0"
                   value="{{ old('experiencia_anios', $tecnologia->experiencia_anios) }}"
                   class="w-full px-4 py-2 rounded border @error('experiencia_anios') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('experiencia_anios')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Descripción --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Descripción</label>
            <textarea name="descripcion" rows="3"
                      class="w-full px-4 py-2 rounded border @error('descripcion') border-red-500 @else border-gray-300 @enderror
                             focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ old('descripcion', $tecnologia->descripcion) }}</textarea>
            @error('descripcion')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <hr>
        {{-- Botones --}}
        <div class="flex justify-start space-x-2 mt-6">
            <a href="{{ route('tecnologias.index') }}" 
               class="px-4 py-1 bg-gray-300 text-gray-800 rounded shadow hover:bg-gray-400 transition">
                Volver
            </a>

            <button type="submit" 
                    class="px-4 py-1 bg-blue-500 text-white rounded shadow hover:bg-blue-600 transition">
                Actualizar
            </button>
        </div>
    </form>
</div>
@endsection
