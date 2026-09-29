@props(['name', 'class' => ''])
@php
    // Iconos de trazo simple (24x24). Se dibujan en línea: sin librería de iconos en el cliente.
    $paths = [
        'download' => '<path d="M12 4v11m0 0-4-4m4 4 4-4M5 20h14"/>',
        'arrow-right' => '<path d="M5 12h14m0 0-6-6m6 6-6 6"/>',
        'external' => '<path d="M14 5h5v5m0-5-8 8M18 14v4a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h4"/>',
        'home' => '<path d="M4 11.5 12 5l8 6.5V19a1 1 0 0 1-1 1h-4v-6H9v6H5a1 1 0 0 1-1-1z"/>',
        'user' => '<circle cx="12" cy="8" r="3.5"/><path d="M5 20c.7-3.5 3.6-5.5 7-5.5s6.3 2 7 5.5"/>',
        'book' => '<path d="M5 5.5A1.5 1.5 0 0 1 6.5 4H19v14H6.5A1.5 1.5 0 0 0 5 19.5zM5 19.5A1.5 1.5 0 0 0 6.5 21H19"/>',
        'code' => '<path d="m8 8-4 4 4 4m8-8 4 4-4 4m-2-10-4 12"/>',
        'briefcase' => '<rect x="4" y="7" width="16" height="12" rx="1.5"/><path d="M9 7V5.5A1.5 1.5 0 0 1 10.5 4h3A1.5 1.5 0 0 1 15 5.5V7M4 12h16"/>',
        'layers' => '<path d="m12 4 8 4-8 4-8-4zM4 12l8 4 8-4M4 16l8 4 8-4"/>',
        'inbox' => '<path d="M4 13h4l1 2h6l1-2h4M4 13l2-7h12l2 7v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1z"/>',
        'plus' => '<path d="M12 5v14M5 12h14"/>',
        'pencil' => '<path d="m4 20 1-4L16 5l3 3L8 19zM14 7l3 3"/>',
        'trash' => '<path d="M5 7h14M10 7V5h4v2m-8 0 1 12h10l1-12M10 11v5m4-5v5"/>',
        'log-out' => '<path d="M14 5h4a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-4M10 8l-4 4 4 4m-4-4h11"/>',
        'menu' => '<path d="M4 7h16M4 12h16M4 17h16"/>',
        'x' => '<path d="m6 6 12 12M18 6 6 18"/>',
        'check' => '<path d="m5 12.5 4.5 4.5L19 7.5"/>',
        'eye' => '<path d="M2.5 12S6 6 12 6s9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"/><circle cx="12" cy="12" r="2.5"/>',
    ];
@endphp
<svg {{ $attributes->class([$class]) }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">{!! $paths[$name] ?? '' !!}</svg>
