@props(['edit', 'delete', 'label'])
<div class="actions">
    <a class="iconbtn" href="{{ $edit }}" title="Editar" aria-label="Editar {{ $label }}"><x-icon name="pencil"/></a>
    <button class="iconbtn iconbtn--danger" type="button" data-delete="{{ $delete }}" data-label="{{ $label }}" title="Eliminar" aria-label="Eliminar {{ $label }}"><x-icon name="trash"/></button>
</div>
