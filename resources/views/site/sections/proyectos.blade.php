@php $otros = $proyectos->reject->es_caso; @endphp
<section id="proyectos" class="section" aria-labelledby="proyectos-titulo">
    <div class="container">
        <div class="section__head">
            <p class="eyebrow">Proyectos</p>
            <h2 id="proyectos-titulo">{{ $casos->isNotEmpty() ? 'Casos técnicos' : 'Proyectos' }}</h2>
            @if ($casos->isNotEmpty())
                <p class="section__lead">Qué problema resolvía cada uno, qué se construyó, cómo está armado y qué decisiones se tomaron.</p>
            @endif
        </div>

        @if ($casos->isNotEmpty())
            <div class="cases">
                <nav class="cases__list" data-case-list aria-label="Proyectos">
                    @foreach ($casos as $p)
                        <a class="cases__tab" href="#proyecto-{{ $p->id }}" data-case-tab="{{ $p->id }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            <strong>{{ $p->titulo }}</strong>
                            @if (count($p->tecnologias_lista))<span>{{ implode(' · ', array_slice($p->tecnologias_lista, 0, 3)) }}</span>@endif
                        </a>
                    @endforeach
                </nav>

                <div>
                    @foreach ($casos as $p)
                        <div class="case" id="proyecto-{{ $p->id }}" data-case="{{ $p->id }}" aria-label="{{ $p->titulo }}">
                            <header class="case__head">
                                <h3>{{ $p->titulo }}</h3>
                                @if ($p->descripcion)<p>{{ $p->descripcion }}</p>@endif
                                @if ($p->url || $p->repositorio_url)
                                    <div class="case__links">
                                        @if ($p->url)<a class="link" href="{{ $p->url }}" target="_blank" rel="noopener noreferrer">Ver proyecto ↗</a>@endif
                                        @if ($p->repositorio_url)<a class="link" href="{{ $p->repositorio_url }}" target="_blank" rel="noopener noreferrer">Repositorio ↗</a>@endif
                                    </div>
                                @endif
                            </header>

                            @if ($p->problema || $p->construccion)
                                <div class="case__cols">
                                    @if ($p->problema)<section class="case__block"><h4 class="subhead">Problema</h4><p>{{ $p->problema }}</p></section>@endif
                                    @if ($p->construccion)<section class="case__block"><h4 class="subhead">Qué construí</h4><p>{{ $p->construccion }}</p></section>@endif
                                </div>
                            @endif

                            @if ($p->arquitectura || count($p->pasos_flujo))
                                <section class="case__block">
                                    <h4 class="subhead">Arquitectura</h4>
                                    @if ($p->arquitectura)<p style="margin-bottom:1rem">{{ $p->arquitectura }}</p>@endif
                                    <x-flow :pasos="$p->pasos_flujo"/>
                                </section>
                            @endif

                            @if (count($p->decisiones_lista))
                                <section class="case__block">
                                    <h4 class="subhead">Decisiones técnicas</h4>
                                    <ul>@foreach ($p->decisiones_lista as $d)<li>{{ $d }}</li>@endforeach</ul>
                                </section>
                            @endif

                            @if ($p->desafios || $p->resultado)
                                <div class="case__cols">
                                    @if ($p->desafios)<section class="case__block"><h4 class="subhead">Desafíos</h4><p>{{ $p->desafios }}</p></section>@endif
                                    @if ($p->resultado)<section class="case__block"><h4 class="subhead">Resultado</h4><p>{{ $p->resultado }}</p></section>@endif
                                </div>
                            @endif

                            @if (count($p->tecnologias_lista))
                                <ul class="tags" aria-label="Tecnologías">@foreach ($p->tecnologias_lista as $t)<li class="tag">{{ $t }}</li>@endforeach</ul>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if ($otros->isNotEmpty())
            <div class="{{ $casos->isNotEmpty() ? 'others' : '' }}">
                @if ($casos->isNotEmpty())<h3 class="subhead">Otros proyectos</h3>@endif
                <ul class="{{ $casos->isNotEmpty() ? '' : 'others' }}">
                    @foreach ($otros as $p)
                        <li class="others__item">
                            <div>
                                <strong>{{ $p->titulo }}</strong>
                                @if ($p->url)<div><a class="link" href="{{ $p->url }}" target="_blank" rel="noopener noreferrer">Ver proyecto ↗</a></div>@endif
                            </div>
                            <div style="display:grid;gap:.6rem">
                                @if ($p->descripcion)<p>{{ $p->descripcion }}</p>@endif
                                @if (count($p->tecnologias_lista))
                                    <ul class="tags">@foreach ($p->tecnologias_lista as $t)<li class="tag">{{ $t }}</li>@endforeach</ul>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</section>
