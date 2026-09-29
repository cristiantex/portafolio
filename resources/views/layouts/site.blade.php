<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $titulo }}</title>
    <meta name="description" content="{{ $descripcion }}">
    <meta name="theme-color" content="#0c0e11">
    <link rel="canonical" href="{{ url('/') }}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    <meta property="og:type" content="profile">
    <meta property="og:locale" content="es_CL">
    <meta property="og:title" content="{{ $titulo }}">
    <meta property="og:description" content="{{ $descripcion }}">
    <meta property="og:url" content="{{ url('/') }}">
    @isset($imagen)<meta property="og:image" content="{{ $imagen }}">@endisset
    <meta name="twitter:card" content="summary">

    @isset($jsonLd)<script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>@endisset

    @vite(['resources/css/site.css', 'resources/js/site.js'])
</head>
<body>
    <a class="skip-link" href="#contenido">Saltar al contenido</a>
    {{ $slot }}
</body>
</html>
