@props(['pasos' => []])
{{-- Diagrama de flujo simple: cada paso es una caja y entre pasos hay una flecha. --}}
@if (count($pasos))
    <ol class="flow" aria-label="Flujo: {{ implode(' → ', $pasos) }}">
        @foreach ($pasos as $paso)
            <li class="flow__node">
                <span class="flow__box">{{ $paso }}</span>
                @unless ($loop->last)<span class="flow__arrow" aria-hidden="true"></span>@endunless
            </li>
        @endforeach
    </ol>
@endif
