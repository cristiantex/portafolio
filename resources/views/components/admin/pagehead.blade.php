@props(['titulo', 'descripcion' => null])
<div class="pagehead">
    <div>
        <h1>{{ $titulo }}</h1>
        @if ($descripcion)<p>{{ $descripcion }}</p>@endif
    </div>
    @if (! $slot->isEmpty())<div>{{ $slot }}</div>@endif
</div>
