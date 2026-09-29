@php $editando = $experiencia->exists; @endphp
<x-admin-layout :titulo="$editando ? 'Editar experiencia' : 'Nueva experiencia'" activo="experiencias.index">
    <x-admin.pagehead :titulo="$editando ? 'Editar experiencia' : 'Nueva experiencia'"/>

    <form class="form" method="POST" action="{{ $editando ? route('experiencias.update', $experiencia) : route('experiencias.store') }}" novalidate>
        @csrf
        @if ($editando) @method('PUT') @endif

        <fieldset class="fieldset">
            <legend>Rol</legend>
            <div class="grid2">
                <x-form.field name="empresa" label="Empresa" :value="$experiencia->empresa" required/>
                <x-form.field name="cargo" label="Cargo" :value="$experiencia->cargo" required/>
                <x-form.field name="fecha_inicio" label="Inicio" type="date" :value="$experiencia->fecha_inicio?->format('Y-m-d')" required/>
                <x-form.field name="fecha_fin" label="Término" type="date" :value="$experiencia->fecha_fin?->format('Y-m-d')" hint="Déjalo vacío si es tu trabajo actual."/>
            </div>
            <x-form.textarea name="descripcion" label="Resumen del rol" :value="$experiencia->descripcion" :rows="3" :max="2000" hint="Qué hacías, en dos o tres líneas."/>
        </fieldset>

        <fieldset class="fieldset">
            <legend>Historia de ingeniería</legend>
            <p class="fieldset__note">Opcional. Si completas al menos uno de estos campos, el sitio muestra la experiencia como Contexto → Problema → Solución → Resultado.</p>
            <x-form.textarea name="contexto" label="Contexto" :value="$experiencia->contexto" :max="1500" hint="Sistema, equipo o situación de partida."/>
            <x-form.textarea name="problema" label="Problema" :value="$experiencia->problema" :max="1500"/>
            <x-form.textarea name="solucion" label="Solución" :value="$experiencia->solucion" :max="1500" hint="Qué decidiste y qué construiste."/>
            <x-form.textarea name="logros" label="Resultados" :value="$experiencia->logros" :rows="3" :max="2000" hint="Uno por elemento, separados por <code>;</code>. Incluye solo resultados que puedas respaldar."/>
        </fieldset>

        <fieldset class="fieldset">
            <legend>Tecnologías</legend>
            <x-form.field name="tecnologias" label="Tecnologías usadas" :value="$experiencia->tecnologias" data-counter="255" maxlength="255" hint="Separadas por coma. Ej.: <code>Java, Spring Boot, MySQL</code>"/>
        </fieldset>

        <div class="form__actions">
            <button class="btn btn--primary" type="submit">Guardar</button>
            <a class="btn" href="{{ route('experiencias.index') }}">Cancelar</a>
        </div>
    </form>
</x-admin-layout>
