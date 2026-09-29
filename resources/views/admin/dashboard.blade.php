<x-admin-layout titulo="Resumen" activo="welcome">
    <x-admin.pagehead :titulo="'Resumen'" :descripcion="$perfil ? 'Estado del contenido que se muestra en el sitio público.' : 'Empieza creando el perfil: sin él el sitio público no puede mostrarse.'">
        <a class="btn" href="{{ route('home') }}" target="_blank" rel="noopener">Ver sitio público</a>
    </x-admin.pagehead>

    <dl class="stats">
        @foreach ($conteos as $nombre => $total)
            <div class="stat"><dt>{{ $nombre }}</dt><dd>{{ $total }}</dd></div>
        @endforeach
        <div class="stat"><dt>Publicados</dt><dd>{{ $publicados }}<small>de {{ $publicados + $pendientes }}</small></dd></div>
    </dl>

    <div class="dash">
        <section class="panel" aria-labelledby="pend">
            <h2 class="panel__head" id="pend">Contenido por completar @if ($sinLeer)<a href="{{ route('mensajes.index') }}" style="color:var(--accent)">{{ $sinLeer }} mensaje(s) sin leer</a>@endif</h2>
            <div class="panel__body">
                @if (count($pendientesDeContenido))
                    <ul class="todo">
                        @foreach ($pendientesDeContenido as $p)
                            <li><span aria-hidden="true">›</span><span><a href="{{ route($p['ruta']) }}">{{ $p['texto'] }}</a></span></li>
                        @endforeach
                    </ul>
                @else
                    <p class="done"><x-icon name="check"/> El sitio público muestra todas sus secciones.</p>
                @endif
            </div>
        </section>

        <section class="panel" aria-labelledby="uso">
            <h2 class="panel__head" id="uso">Tecnologías en proyectos</h2>
            <div class="panel__body">
                @php $max = max(1, ...array_values($usoTecnologias ?: [1])); @endphp
                @forelse ($usoTecnologias as $nombre => $total)
                    @if ($loop->first)<ul class="bars">@endif
                    <li><span title="{{ $nombre }}">{{ $nombre }}</span><div class="bar"><i style="width:{{ round($total / $max * 100) }}%"></i></div><b>{{ $total }}</b></li>
                    @if ($loop->last)</ul>@endif
                @empty
                    <p class="hint">Aún no hay tecnologías registradas en proyectos.</p>
                @endforelse
            </div>
        </section>
    </div>
</x-admin-layout>
