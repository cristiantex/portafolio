<section id="perfil" class="section" aria-labelledby="perfil-titulo">
    <div class="container">
        <div class="section__head">
            <p class="eyebrow">Perfil</p>
            <h2 id="perfil-titulo">Trayectoria y forma de trabajar</h2>
        </div>

        <div class="perfil">
            <div class="perfil__text">
                @if ($perfil->foto_url)
                    <img class="perfil__photo" src="{{ $perfil->foto_url }}" alt="Foto de {{ $perfil->nombre }}" width="112" height="112" loading="lazy">
                @endif

                @foreach (preg_split('/\R{2,}/', trim((string) $perfil->descripcion)) as $parrafo)
                    @if ($parrafo !== '')<p>{{ $parrafo }}</p>@endif
                @endforeach

                @if (count($perfil->enfoque_lista))
                    <div>
                        <h3 class="subhead">Problemas que resuelvo</h3>
                        <ul class="checks">
                            @foreach ($perfil->enfoque_lista as $item)<li>{{ $item }}</li>@endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div>
                @if ($trayectoria->isNotEmpty())
                    <h3 class="subhead">Trayectoria</h3>
                    <ol class="timeline">
                        @foreach ($trayectoria as $exp)
                            <li data-actual="{{ $exp->es_actual ? 'true' : 'false' }}">
                                <p class="timeline__when">{{ $exp->fecha_inicio->format('Y') }} – {{ $exp->fecha_fin?->format('Y') ?? 'actualidad' }}</p>
                                <p class="timeline__what">{{ $exp->cargo }}</p>
                                <p class="timeline__where">{{ $exp->empresa }}</p>
                            </li>
                        @endforeach
                    </ol>
                @endif

                @if ($perfil->rumbo)
                    <div class="rumbo">
                        <h3 class="subhead" style="margin-bottom:.4rem">Hacia dónde evoluciona</h3>
                        <p>{{ $perfil->rumbo }}</p>
                    </div>
                @endif
            </div>
        </div>

        @if ($formaciones->isNotEmpty())
            <div style="margin-top:3rem">
                <h3 class="subhead">Formación</h3>
                <ul class="formacion">
                    @foreach ($formaciones as $f)
                        <li>
                            <span class="formacion__when">{{ $f->fecha_inicio->format('Y') }} – {{ $f->fecha_fin?->format('Y') ?? 'en curso' }}</span>
                            <div>
                                <p class="formacion__what">{{ $f->titulo }}</p>
                                <p class="formacion__where">{{ $f->institucion }} · {{ $f->tipo }}
                                    @if ($f->certificado_url) · <a class="link" href="{{ $f->certificado_url }}" target="_blank" rel="noopener noreferrer">Ver certificado</a>@endif
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</section>
