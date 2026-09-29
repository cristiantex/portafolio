<x-admin-layout titulo="Perfil" activo="perfil.edit">
    <x-admin.pagehead titulo="Perfil" descripcion="Datos personales y textos de presentación del sitio público. Lo que dejes vacío no se muestra."/>

    <form class="form" method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data" novalidate>
        @csrf

        <fieldset class="fieldset">
            <legend>Identidad</legend>
            <div class="grid2">
                <x-form.field name="alias" label="Alias" :value="$perfil->alias" required hint="Aparece en la barra superior."/>
                <x-form.field name="nombre" label="Nombre completo" :value="$perfil->nombre" required/>
            </div>
            <div class="grid2">
                <x-form.field name="profesion" label="Rol profesional" :value="$perfil->profesion" hint="Ej.: Ingeniero de Software."/>
                <x-form.field name="ubicacion" label="Ubicación" :value="$perfil->ubicacion"/>
            </div>
        </fieldset>

        <fieldset class="fieldset">
            <legend>Presentación</legend>
            <p class="fieldset__note">Qué haces y qué problemas resuelves, en lenguaje concreto. Evita adjetivos: describe sistemas, tecnologías y resultados.</p>
            <x-form.field name="titular" label="Titular" :value="$perfil->titular" hint="Una o dos frases para el inicio. Si queda vacío se usa la primera oración de la descripción."/>
            <x-form.textarea name="descripcion" label="Descripción" :value="$perfil->descripcion" :rows="5" :max="1500" hint="Separa los párrafos con una línea en blanco."/>
            <x-form.textarea name="enfoque" label="Problemas que resuelvo" :value="$perfil->enfoque" :rows="3" :max="1500" hint="Uno por elemento, separados por <code>;</code>. Ej.: Modernización de aplicaciones existentes; Integración entre sistemas."/>
            <x-form.field name="rumbo" label="Hacia dónde evoluciona el perfil" :value="$perfil->rumbo" hint="Solo si corresponde a tu trayectoria real."/>
        </fieldset>

        <fieldset class="fieldset">
            <legend>Contacto</legend>
            <div class="grid2">
                <x-form.field name="email" label="Correo" type="email" :value="$perfil->email"/>
                <x-form.field name="telefono" label="Teléfono" type="tel" :value="$perfil->telefono"/>
                <x-form.field name="linkedin" label="LinkedIn" type="url" :value="$perfil->linkedin" hint="URL completa, con https://"/>
                <x-form.field name="github" label="GitHub" type="url" :value="$perfil->github" hint="URL completa, con https://"/>
            </div>
        </fieldset>

        <fieldset class="fieldset">
            <legend>Archivos</legend>
            <div class="grid2">
                <div>
                    <x-form.field name="foto_perfil" label="Foto" type="file" accept="image/*" hint="JPG, PNG o WebP, hasta 2 MB. Opcional."/>
                    @if ($perfil->foto_url)<p class="current" style="margin-top:.6rem"><img src="{{ $perfil->foto_url }}" alt="Foto actual"> Foto actual</p>@endif
                </div>
                <div>
                    <x-form.field name="cv" label="Currículum (PDF)" type="file" accept="application/pdf" hint="Habilita el botón “Descargar CV”. Hasta 5 MB."/>
                    @if ($perfil->cv_url)<p class="current" style="margin-top:.6rem"><a class="link" href="{{ $perfil->cv_url }}" target="_blank" rel="noopener" style="color:var(--accent)">CV actual</a></p>@endif
                </div>
            </div>
        </fieldset>

        <div class="form__actions"><button class="btn btn--primary" type="submit">Guardar perfil</button></div>
    </form>
</x-admin-layout>
