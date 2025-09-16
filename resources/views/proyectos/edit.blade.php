@extends('layouts.app')

@section('title', 'Editar Proyecto')

@section('content')
<div class="bg-white rounded-lg shadow p-6 w-full min-h-[80vh]">

    <h2 class="text-2xl font-bold mb-4 text-gray-800">Editar Proyecto</h2>

    @if($errors->any())
        <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
            Por favor corrige los errores en los campos resaltados.
        </div>
    @endif

    <form action="{{ route('proyectos.update', $proyecto) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Título --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Título <span class="text-red-500">*</span></label>
            <input type="text" name="titulo" value="{{ old('titulo', $proyecto->titulo) }}"
                   class="w-full px-4 py-2 rounded border @error('titulo') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('titulo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Descripción --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Descripción</label>
            <textarea name="descripcion" rows="3"
                      class="w-full px-4 py-2 rounded border @error('descripcion') border-red-500 @else border-gray-300 @enderror
                             focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ old('descripcion', $proyecto->descripcion) }}</textarea>
            @error('descripcion')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- URL --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">URL</label>
            <input type="url" name="url" value="{{ old('url', $proyecto->url) }}"
                   class="w-full px-4 py-2 rounded border @error('url') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('url')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Imagen --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Imagen</label>
            <input type="file" name="imagen"
                   class="w-full px-4 py-2 rounded border @error('imagen') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('imagen')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            @if($proyecto->imagen)
                <img src="{{ asset($proyecto->imagen) }}" alt="{{ $proyecto->titulo }}" class="w-24 h-24 object-cover rounded mt-2">
            @endif
        </div>

        {{-- Tecnologías --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Tecnologías</label>
            <input type="text" name="tecnologias" value="{{ old('tecnologias', $proyecto->tecnologias) }}"
                   placeholder="Ejemplo: PHP, Laravel, MySQL"
                   class="w-full px-4 py-2 rounded border @error('tecnologias') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            <p class="text-gray-500 text-sm mt-1">Escriba varias tecnologías separadas por comas.</p>
            @error('tecnologias')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Publicado --}}
        <div class="flex items-center space-x-2">
            <input type="checkbox" name="publicado" value="1" {{ old('publicado', $proyecto->publicado) ? 'checked' : '' }} id="publicado">
            <label for="publicado" class="text-gray-700 font-medium">Publicado</label>
        </div>

        <hr>
        {{-- Botones --}}
        <div class="flex justify-start space-x-2 mt-6">
            <a href="{{ route('proyectos.index') }}" 
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