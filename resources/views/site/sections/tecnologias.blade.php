<section id="tecnologias" class="section" aria-labelledby="tecnologias-titulo">
    <div class="container">
        <div class="section__head">
            <p class="eyebrow">Tecnologías</p>
            <h2 id="tecnologias-titulo">Stack por área</h2>
            <p class="section__lead">Agrupado por lo que cada tecnología resuelve, con los años de uso y para qué la he usado.</p>
        </div>

        <div class="stack">
            @foreach ($tecnologias as $categoria => $items)
                <section class="stack__group">
                    <h3>{{ $categoria }} <span>{{ $items->count() }}</span></h3>
                    <ul>
                        @foreach ($items as $t)
                            <li class="stack__item">
                                <strong>{{ $t->nombre }}</strong>
                                @if ($t->experiencia_anios)
                                    <span class="stack__years">{{ $t->experiencia_anios }} {{ $t->experiencia_anios === 1 ? 'año' : 'años' }}</span>
                                @endif
                                @if ($t->descripcion)<p>{{ $t->descripcion }}</p>@endif
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endforeach
        </div>
    </div>
</section>
