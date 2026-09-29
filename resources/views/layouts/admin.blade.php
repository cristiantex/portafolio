<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#0c0e11">
    <title>{{ $titulo }} · Mantenedor</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body>
    <a class="skip-link sr-only" href="#contenido">Saltar al contenido</a>
    <div class="shell">
        <aside class="side" id="side" data-open="false" aria-label="Mantenedor">
            <div class="side__brand"><strong>Mantenedor</strong><span>Portafolio</span></div>
            <nav class="side__nav" aria-label="Secciones">
                @foreach ($nav as $ruta => [$texto, $icono])
                    @php $activa = $activo === $ruta || request()->routeIs(str_replace('.index', '.*', $ruta)) && $ruta !== 'welcome'; @endphp
                    <a href="{{ route($ruta) }}" @if ($activa) aria-current="page" @endif>
                        <x-icon :name="$icono"/> {{ $texto }}
                        @if ($ruta === 'mensajes.index' && $sinLeer)<span class="side__count" aria-label="{{ $sinLeer }} sin leer">{{ $sinLeer }}</span>@endif
                    </a>
                @endforeach
            </nav>
            <div class="side__foot">
                <a href="{{ route('home') }}" target="_blank" rel="noopener"><x-icon name="eye"/> Ver sitio público</a>
                <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit"><x-icon name="log-out"/> Cerrar sesión</button></form>
            </div>
        </aside>
        <div class="scrim" id="scrim" hidden></div>

        <div class="main">
            <div class="mobilebar">
                <button type="button" data-side-toggle aria-controls="side" aria-expanded="false" aria-label="Abrir menú"><x-icon name="menu" style="width:1.1rem;height:1.1rem"/></button>
                <strong>{{ $titulo }}</strong>
            </div>
            <main class="page" id="contenido">
                @if (session('success'))
                    <div class="flash flash--ok" role="status"><x-icon name="check" style="width:1rem;height:1rem;color:var(--ok);flex:none;margin-top:.15rem"/> {{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="flash flash--error" role="alert">Hay {{ $errors->count() === 1 ? 'un campo' : $errors->count().' campos' }} por corregir. Están marcados abajo.</div>
                @endif
                {{ $slot }}
            </main>
        </div>
    </div>

    <dialog id="delete-dialog" aria-labelledby="delete-title">
        <h2 id="delete-title">¿Eliminar <span data-delete-label>este registro</span>?</h2>
        <p>Esta acción no se puede deshacer.</p>
        <form method="POST" class="form__actions">
            @csrf @method('DELETE')
            <button type="button" class="btn" data-cancel>Cancelar</button>
            <button type="submit" class="btn btn--danger">Eliminar</button>
        </form>
    </dialog>
</body>
</html>
