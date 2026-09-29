@php
    $titulo = $perfil->nombre.($perfil->profesion ? ' — '.$perfil->profesion : '');
    $descripcion = \Illuminate\Support\Str::limit($perfil->resumen ?? $titulo, 158);
    $jsonLd = array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        'name' => $perfil->nombre,
        'jobTitle' => $perfil->profesion,
        'description' => $descripcion,
        'url' => url('/'),
        'email' => $perfil->email ? 'mailto:'.$perfil->email : null,
        'image' => $perfil->foto_url,
        'sameAs' => array_values(array_filter([$perfil->linkedin, $perfil->github])),
        'address' => $perfil->ubicacion ? ['@type' => 'PostalAddress', 'addressLocality' => $perfil->ubicacion] : null,
    ]);
@endphp
<x-site-layout :titulo="$titulo" :descripcion="$descripcion" :imagen="$perfil->foto_url" :json-ld="$jsonLd">
    @include('site.sections.header')
    <main id="contenido">
        @include('site.sections.hero')
        @include('site.sections.perfil')
        @if ($experiencias->isNotEmpty()) @include('site.sections.experiencia') @endif
        @if ($proyectos->isNotEmpty()) @include('site.sections.proyectos') @endif
        @if ($tecnologias->isNotEmpty()) @include('site.sections.tecnologias') @endif
        @include('site.sections.arquitectura')
        @include('site.sections.contacto')
    </main>
    @include('site.sections.footer')
</x-site-layout>
