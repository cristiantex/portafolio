<x-admin-layout titulo="Mensajes" activo="mensajes.index">
    <x-admin.pagehead titulo="Mensajes" descripcion="Lo que llega desde el formulario de contacto del sitio."/>

    @if ($mensajes->isEmpty())
        <div class="panel"><div class="empty"><p>Aún no has recibido mensajes.</p></div></div>
    @else
        <div class="msgs">
            @foreach ($mensajes as $m)
                <article class="msg" data-unread="{{ $m->leido ? 'false' : 'true' }}">
                    <div class="msg__meta">
                        <strong>{{ $m->nombre }}</strong>
                        <a href="mailto:{{ $m->email }}">{{ $m->email }}</a>
                        <time datetime="{{ $m->created_at->toIso8601String() }}">{{ $m->created_at->format('d/m/Y H:i') }}</time>
                        @unless ($m->leido)<span class="badge badge--warn">nuevo</span>@endunless
                    </div>
                    <p>{{ $m->mensaje }}</p>
                    <div class="msg__actions">
                        <form method="POST" action="{{ route('mensajes.leido', $m) }}">@csrf @method('PATCH')
                            <button class="btn" type="submit">{{ $m->leido ? 'Marcar como no leído' : 'Marcar como leído' }}</button>
                        </form>
                        <button class="btn" type="button" data-delete="{{ route('mensajes.destroy', $m) }}" data-label="el mensaje de {{ $m->nombre }}">Eliminar</button>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</x-admin-layout>
