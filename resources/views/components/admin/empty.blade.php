@props(['texto', 'href', 'accion'])
<div class="empty">
    <p>{{ $texto }}</p>
    <a class="btn btn--primary" href="{{ $href }}"><x-icon name="plus"/> {{ $accion }}</a>
</div>
