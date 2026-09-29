<section id="experiencia" class="section" aria-labelledby="experiencia-titulo">
    <div class="container">
        <div class="section__head">
            <p class="eyebrow">Experiencia</p>
            <h2 id="experiencia-titulo">Dónde y cómo he trabajado</h2>
            <p class="section__lead">Cada rol se describe por el contexto en que ocurrió, el problema, la solución aplicada y su resultado.</p>
        </div>

        <div class="exp">
            @foreach ($experiencias as $exp)
                <article class="exp__item">
                    <p class="exp__when">
                        <span>{{ $exp->fecha_inicio->format('m/Y') }} – {{ $exp->fecha_fin?->format('m/Y') ?? 'actualidad' }}</span>
                        <span>{{ $exp->duracion }}</span>
                        @if ($exp->es_actual)<span class="exp__badge">● en curso</span>@endif
                    </p>

                    <div class="exp__body">
                        <header class="exp__head">
                            <h3>{{ $exp->cargo }}</h3>
                            <p>{{ $exp->empresa }}</p>
                        </header>

                        @if ($exp->descripcion)
                            <p class="exp__summary">{{ $exp->descripcion }}</p>
                        @endif

                        @if ($exp->es_caso || count($exp->resultados))
                            <div class="story">
                                @foreach (['contexto' => 'Contexto', 'problema' => 'Problema', 'solucion' => 'Solución'] as $campo => $etiqueta)
                                    @if ($exp->{$campo})
                                        <section class="story__step"><h4>{{ $etiqueta }}</h4><p>{{ $exp->{$campo} }}</p></section>
                                    @endif
                                @endforeach
                                @if (count($exp->resultados))
                                    <section class="story__step">
                                        <h4>Resultado</h4>
                                        <ul>@foreach ($exp->resultados as $r)<li>{{ $r }}</li>@endforeach</ul>
                                    </section>
                                @endif
                            </div>
                        @endif

                        @if (count($exp->tecnologias_lista))
                            <ul class="tags" aria-label="Tecnologías">
                                @foreach ($exp->tecnologias_lista as $t)<li class="tag">{{ $t }}</li>@endforeach
                            </ul>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
