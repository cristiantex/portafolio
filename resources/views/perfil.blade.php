{{-- resources/views/perfil.blade.php --}}
@extends('layouts.app')

@section('title', 'Perfil')

@section('content')
<div class="bg-white rounded-lg shadow p-6 w-full min-h-[80vh]">

    <h2 class="text-2xl font-bold mb-4 text-gray-800">Perfil</h2>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="mb-4 p-4 rounded bg-green-100 text-green-800 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Mensaje general de errores --}}
    @if($errors->any())
        <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
            Por favor corrige los errores en los campos resaltados.
        </div>
    @endif

    <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Alias --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Alias <span class="text-red-500">*</span></label>
            <input type="text" name="alias" value="{{ old('alias', $perfil->alias ?? '') }}"
                   class="w-full px-4 py-2 rounded border 
                          @error('alias') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('alias')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nombre --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Nombre <span class="text-red-500">*</span></label>
            <input type="text" name="nombre" value="{{ old('nombre', $perfil->nombre ?? '') }}"
                   class="w-full px-4 py-2 rounded border
                          @error('nombre') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('nombre')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Profesión --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Profesión</label>
            <input type="text" name="profesion" value="{{ old('profesion', $perfil->profesion ?? '') }}"
                   class="w-full px-4 py-2 rounded border
                          @error('profesion') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('profesion')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Descripción --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Descripción</label>
            <textarea name="descripcion" rows="4"
                      class="w-full px-4 py-2 rounded border
                             @error('descripcion') border-red-500 @else border-gray-300 @enderror
                             focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ old('descripcion', $perfil->descripcion ?? '') }}</textarea>
            @error('descripcion')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $perfil->email ?? '') }}"
                   class="w-full px-4 py-2 rounded border
                          @error('email') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Teléfono --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Teléfono</label>
            <input type="text" name="telefono" value="{{ old('telefono', $perfil->telefono ?? '') }}"
                   class="w-full px-4 py-2 rounded border
                          @error('telefono') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('telefono')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- LinkedIn --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">LinkedIn</label>
            <input type="text" name="linkedin" value="{{ old('linkedin', $perfil->linkedin ?? '') }}"
                   class="w-full px-4 py-2 rounded border
                          @error('linkedin') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('linkedin')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- GitHub --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">GitHub</label>
            <input type="text" name="github" value="{{ old('github', $perfil->github ?? '') }}"
                   class="w-full px-4 py-2 rounded border
                          @error('github') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('github')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Foto de Perfil --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Foto de Perfil</label>
            <input type="file" name="foto_perfil"
                   class="w-full text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0
                          file:text-sm file:font-semibold file:bg-blue-500 file:text-white
                          hover:file:bg-blue-600">
            @error('foto_perfil')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            @if(!empty($perfil->foto_perfil))
                <div class="mt-3">
                    <img src="{{ asset('storage/'.$perfil->foto_perfil) }}" alt="Foto de perfil"
                         class="h-32 w-32 object-cover rounded-full border border-gray-300">
                </div>
            @endif
        </div>

        {{-- Botón Guardar --}}
        <div class="text-right">
            <button type="submit"
                    class="px-6 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600 transition">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection
