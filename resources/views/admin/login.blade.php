<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#0c0e11">
    <title>Acceso al mantenedor</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/admin.css'])
</head>
<body>
    <main class="login">
        <div class="login__card">
            <div>
                <h1>Mantenedor</h1>
                <p>Acceso para editar el contenido del portafolio.</p>
            </div>

            <form class="panel" method="POST" action="{{ route('login.post') }}" novalidate>
                @csrf
                <div class="panel__body">
                    @if ($errors->any())
                        <div class="flash flash--error" role="alert" style="margin:0">{{ $errors->first() }}</div>
                    @endif
                    <x-form.field name="user" label="Usuario" :value="old('user')" required autocomplete="username" autofocus/>
                    <x-form.field name="password" label="Contraseña" type="password" required autocomplete="current-password"/>
                    <button class="btn btn--primary" type="submit" style="justify-content:center">Ingresar</button>
                </div>
            </form>

            <a class="login__back" href="{{ route('home') }}">← Volver al sitio</a>
        </div>
    </main>
</body>
</html>
