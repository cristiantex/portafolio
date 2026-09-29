@php $editando = $tecnologia->exists; @endphp
<x-admin-layout :titulo="$editando ? 'Editar tecnología' : 'Nueva tecnología'" activo="tecnologias.index">
    <x-admin.pagehead :titulo="$editando ? 'Editar tecnología' : 'Nueva tecnología'"/>

    <form class="form" method="POST" action="{{ $editando ? route('tecnologias.update', $tecnologia) : route('tecnologias.store') }}" novalidate>
        @csrf
        @if ($editando) @method('PUT') @endif

        <fieldset class="fieldset">
            <legend>Datos</legend>
            <div class="grid2">
                <x-form.field name="nombre" label="Nombre" :value="$tecnologia->nombre" required/>
                <x-form.select name="categoria" label="Categoría" :options="config('portafolio.categorias_tecnologia')" :value="$tecnologia->categoria" placeholder="Sin categoría" hint="Define en qué grupo aparece en el sitio."/>
                <x-form.select name="nivel" label="Nivel" :options="config('portafolio.niveles_tecnologia')" :value="$tecnologia->nivel" required placeholder="Selecciona…" hint="Uso interno; el sitio público muestra los años, no el nivel."/>
                <x-form.field name="experiencia_anios" label="Años de uso" type="number" min="0" max="60" :value="$tecnologia->experiencia_anios"/>
            </div>
            <x-form.textarea name="descripcion" label="Para qué la has usado" :value="$tecnologia->descripcion" :rows="3" :max="1000" hint="Evidencia concreta: tipo de sistemas, integraciones, tareas. Ej.: “APIs REST y servicios empresariales”."/>
        </fieldset>

        <div class="form__actions">
            <button class="btn btn--primary" type="submit">Guardar</button>
            <a class="btn" href="{{ route('tecnologias.index') }}">Cancelar</a>
        </div>
    </form>
</x-admin-layout>
