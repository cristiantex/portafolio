@php
    $enlaces = array_filter([
        'perfil' => 'Perfil',
        'experiencia' => $experiencias->isNotEmpty() ? 'Experiencia' : null,
        'proyectos' => $proyectos->isNotEmpty() ? 'Proyectos' : null,
        'tecnologias' => $tecnologias->isNotEmpty() ? 'Tecnologías' : null,
        'arquitectura' => 'Arquitectura',
        'contacto' => 'Contacto',
    ]);
@endphp
<header class="topbar">
    <div class="container topbar__inner">
        <a class="brand" href="#inicio" aria-label="Inicio">{{ $perfil->alias }} <span>/ {{ $perfil->profesion ?? 'portafolio' }}</span></a>
        <button class="nav-toggle" type="button" data-nav-toggle aria-controls="nav" aria-expanded="false">
            <x-icon name="menu"/> Menú
        </button>
        <nav id="nav" class="nav" aria-label="Principal">
            @foreach ($enlaces as $id => $texto)
                <a href="#{{ $id }}">{{ $texto }}</a>
            @endforeach
        </nav>
    </div>
</header>
