@php $editando = $formacion->exists; @endphp
<x-admin-layout :titulo="$editando ? 'Editar formación' : 'Nueva formación'" activo="formacion.index">
    <x-admin.pagehead :titulo="$editando ? 'Editar formación' : 'Nueva formación'"/>

    <form class="form" method="POST" action="{{ $editando ? route('formacion.update', $formacion) : route('formacion.store') }}" novalidate>
        @csrf
        @if ($editando) @method('PUT') @endif

        <fieldset class="fieldset">
            <legend>Datos</legend>
            <div class="grid2">
                <x-form.field name="titulo" label="Título" :value="$formacion->titulo" required/>
                <x-form.field name="institucion" label="Institución" :value="$formacion->institucion" required/>
                <x-form.select name="tipo" label="Tipo" :options="config('portafolio.tipos_formacion')" :value="$formacion->tipo" required placeholder="Selecciona…"/>
                <x-form.field name="certificado_url" label="URL del certificado" type="url" :value="$formacion->certificado_url" hint="Opcional. Con https://"/>
                <x-form.field name="fecha_inicio" label="Inicio" type="date" :value="$formacion->fecha_inicio?->format('Y-m-d')" required/>
                <x-form.field name="fecha_fin" label="Término" type="date" :value="$formacion->fecha_fin?->format('Y-m-d')" hint="Vacío si sigue en curso."/>
            </div>
        </fieldset>

        <div class="form__actions">
            <button class="btn btn--primary" type="submit">Guardar</button>
            <a class="btn" href="{{ route('formacion.index') }}">Cancelar</a>
        </div>
    </form>
</x-admin-layout>
