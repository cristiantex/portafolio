@php
    $socials = [
        ['url' => $perfils[0]->email, 'icon' => 'fa-solid fa-envelope', 'bg' => 'bg-blue-600 hover:bg-blue-700', 'text' => 'Email', 'ext' => 'mailto:'],
        ['url' => $perfils[0]->telefono, 'icon' => 'fa-solid fa-phone', 'bg' => 'bg-green-600 hover:bg-green-700', 'text' => 'Teléfono', 'ext' => 'tel:'],
        ['url' => $perfils[0]->linkedin, 'icon' => 'fa-brands fa-linkedin', 'bg' => 'bg-blue-500 hover:bg-blue-600', 'text' => 'LinkedIn', 'ext' => ''],
        ['url' => $perfils[0]->github, 'icon' => 'fa-brands fa-github', 'bg' => 'bg-gray-800 hover:bg-gray-900', 'text' => 'GitHub', 'ext' => ''],
        ['url' => preg_replace('/\D/', '', $perfils[0]->telefono), 'icon' => 'fa-brands fa-whatsapp', 'bg' => 'bg-green-600 hover:bg-green-700', 'text' => 'Whatsapp', 'ext' => 'https://wa.me/'],
    ];
@endphp

@php $separador = 0; @endphp
@foreach ($socials as $s)
    @if(!empty($s['url']))
        @php $separador += 50; $topStyle = "top: calc(30% + {$separador}px);"; @endphp
        <div class="group relative overflow-hidden rounded-l-lg shadow transition-all duration-300 w-12 hover:w-48" 
             style="position: fixed; right: 0; {!! $topStyle !!}">
            <a href="{{ $s['ext'].$s['url'] }}" target="_blank"
               class="flex items-center h-12 {{ $s['bg'] }} transition-all duration-300">
                <i class="{{ $s['icon'] }} text-white text-lg ml-3 flex-shrink-0"></i>
                <span class="ml-3 text-white font-medium whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    {{ $s['text'] }}
                </span>
            </a>
        </div>
    @endif
@endforeach