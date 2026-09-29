@php $editando = $proyecto->exists; @endphp
<x-admin-layout :titulo="$editando ? 'Editar proyecto' : 'Nuevo proyecto'" activo="proyectos.index">
    <x-admin.pagehead :titulo="$editando ? 'Editar proyecto' : 'Nuevo proyecto'"/>

    <form class="form" method="POST" action="{{ $editando ? route('proyectos.update', $proyecto) : route('proyectos.store') }}" enctype="multipart/form-data" novalidate>
        @csrf
        @if ($editando) @method('PUT') @endif

        <fieldset class="fieldset">
            <legend>Proyecto</legend>
            <x-form.field name="titulo" label="Título" :value="$proyecto->titulo" required/>
            <x-form.textarea name="descripcion" label="Qué es" :value="$proyecto->descripcion" :rows="3" :max="2000" hint="Una descripción corta y factual."/>
            <div class="grid2">
                <x-form.field name="url" label="URL del proyecto" type="url" :value="$proyecto->url" hint="Opcional. Con https://"/>
                <x-form.field name="repositorio_url" label="URL del repositorio" type="url" :value="$proyecto->repositorio_url" hint="Opcional."/>
            </div>
            <x-form.field name="tecnologias" label="Tecnologías" :value="$proyecto->tecnologias" maxlength="255" hint="Separadas por coma. Ej.: <code>Laravel, MySQL, Vite</code>"/>
            <div class="field">
                <label class="check"><input type="checkbox" name="publicado" value="1" @checked(old('publicado', $proyecto->publicado))> Publicado en el sitio</label>
            </div>
        </fieldset>

        <fieldset class="fieldset">
            <legend>Caso técnico</legend>
            <p class="fieldset__note">Opcional. Con al menos un campo, el proyecto se presenta como caso de estudio. Completa solo lo que puedas respaldar.</p>
            <x-form.textarea name="problema" label="Problema que resuelve" :value="$proyecto->problema" :max="1500"/>
            <x-form.textarea name="construccion" label="Qué construí" :value="$proyecto->construccion" :max="1500"/>
            <x-form.textarea name="arquitectura" label="Arquitectura" :value="$proyecto->arquitectura" :max="1500" hint="Cómo está organizado: capas, componentes, integraciones."/>
            <x-form.field name="flujo" label="Diagrama de flujo" :value="$proyecto->flujo" maxlength="500" hint="Pasos separados por <code>&gt;</code>. Ej.: <code>Frontend &gt; API &gt; Servicio &gt; Repositorio &gt; Base de datos</code>"/>
            <x-form.textarea name="decisiones" label="Decisiones técnicas" :value="$proyecto->decisiones" :rows="4" :max="2000" hint="Una por elemento, separadas por <code>;</code>. Incluye el porqué."/>
            <x-form.textarea name="desafios" label="Desafíos" :value="$proyecto->desafios" :max="1500"/>
            <x-form.textarea name="resultado" label="Resultado" :value="$proyecto->resultado" :max="1500"/>
        </fieldset>

        <fieldset class="fieldset">
            <legend>Imagen</legend>
            <div>
                <x-form.field name="imagen" label="Imagen del proyecto" type="file" accept="image/*" hint="Opcional, hasta 2 MB."/>
                @if ($proyecto->imagen_url)<p class="current" style="margin-top:.6rem"><img src="{{ $proyecto->imagen_url }}" alt="Imagen actual"> Imagen actual</p>@endif
            </div>
        </fieldset>

        <div class="form__actions">
            <button class="btn btn--primary" type="submit">Guardar</button>
            <a class="btn" href="{{ route('proyectos.index') }}">Cancelar</a>
        </div>
    </form>
</x-admin-layout>
