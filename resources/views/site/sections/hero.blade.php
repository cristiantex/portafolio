@php
    $bases = ($tecnologias['Bases de datos'] ?? collect())->pluck('nombre')->take(4)->implode(', ');
    $ficha = array_filter([
        'Experiencia' => $anosExperiencia !== null ? $anosExperiencia.' años · desde '.$desde->format('Y') : null,
        'Stack' => $stackPrincipal->implode(', ') ?: null,
        'Datos' => $bases ?: null,
        'Resuelve' => collect($perfil->enfoque_lista)->take(3)->implode(' · ') ?: null,
        'Evoluciona' => $perfil->rumbo,
        'Proyectos' => $proyectos->isNotEmpty()
            ? $proyectos->count().' publicados'.($casos->isNotEmpty() ? ' · '.$casos->count().' con caso técnico' : '')
            : null,
        'Ubicación' => $perfil->ubicacion,
    ]);
@endphp
<section id="inicio" class="hero" aria-labelledby="hero-titulo">
    <div class="container hero__grid">
        <div>
            <p class="hero__role">{{ $perfil->profesion }}</p>
            <h1 id="hero-titulo">{{ $perfil->nombre }}</h1>
            @if ($perfil->resumen)
                <p class="hero__statement">{{ $perfil->resumen }}</p>
            @endif
            <div class="hero__actions">
                @if ($experiencias->isNotEmpty())
                    <a class="btn btn--primary" href="#experiencia">Ver experiencia <x-icon name="arrow-right"/></a>
                @endif
                @if ($proyectos->isNotEmpty())
                    <a class="btn" href="#proyectos">Ver proyectos</a>
                @endif
                @if ($perfil->cv_url)
                    <a class="btn" href="{{ $perfil->cv_url }}" download>Descargar CV <x-icon name="download"/></a>
                @endif
                <a class="btn" href="#contacto">Contacto</a>
            </div>
        </div>

        @if ($ficha)
            <aside class="spec" aria-label="Resumen técnico">
                <p class="spec__title">Resumen técnico</p>
                <dl>
                    @foreach ($ficha as $clave => $valor)
                        <div class="spec__row"><dt>{{ $clave }}</dt><dd>{{ $valor }}</dd></div>
                    @endforeach
                </dl>
            </aside>
        @endif
    </div>
</section>
