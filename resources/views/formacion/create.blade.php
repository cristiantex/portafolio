@extends('layouts.app')

@section('title', 'Agregar Formación')

@section('content')
<div class="bg-white rounded-lg shadow p-6 w-full min-h-[80vh]">

    <h2 class="text-2xl font-bold mb-4 text-gray-800">Agregar Formación</h2>

    @if($errors->any())
        <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
            Por favor corrige los errores en los campos resaltados.
        </div>
    @endif

    <form action="{{ route('formacion.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Institución --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Institución <span class="text-red-500">*</span></label>
            <input type="text" name="institucion" value="{{ old('institucion') }}"
                   class="w-full px-4 py-2 rounded border @error('institucion') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('institucion')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Título --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Título <span class="text-red-500">*</span></label>
            <input type="text" name="titulo" value="{{ old('titulo') }}"
                   class="w-full px-4 py-2 rounded border @error('titulo') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('titulo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tipo --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Tipo <span class="text-red-500">*</span></label>
            <select name="tipo"
                    class="w-full px-4 py-2 rounded border @error('tipo') border-red-500 @else border-gray-300 @enderror
                        focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <option value="">Seleccione un tipo</option>
                <option value="Carrera" {{ old('tipo') == 'Carrera' ? 'selected' : '' }}>Carrera</option>
                <option value="Diplomado" {{ old('tipo') == 'Diplomado' ? 'selected' : '' }}>Diplomado</option>
                <option value="Curso" {{ old('tipo') == 'Curso' ? 'selected' : '' }}>Curso</option>
                <option value="Certificación" {{ old('tipo') == 'Certificación' ? 'selected' : '' }}>Certificación</option>
                <option value="Otro" {{ old('tipo') == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
            @error('tipo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Fecha Inicio --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Fecha Inicio <span class="text-red-500">*</span></label>
            <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}"
                   class="w-full px-4 py-2 rounded border @error('fecha_inicio') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('fecha_inicio')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Fecha Fin --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Fecha Fin</label>
            <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}"
                   class="w-full px-4 py-2 rounded border @error('fecha_fin') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('fecha_fin')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Certificado URL --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">URL Certificado</label>
            <input type="url" name="certificado_url" value="{{ old('certificado_url') }}"
                   class="w-full px-4 py-2 rounded border @error('certificado_url') border-red-500 @else border-gray-300 @enderror
                          focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('certificado_url')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <hr>
        {{-- Botones --}}
        <div class="flex justify-start space-x-2 mt-6">
            <a href="{{ route('formacion.index') }}" 
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