@props(['name', 'label', 'type' => 'text', 'value' => null, 'required' => false, 'hint' => null])
@php $id = 'f-'.$name; @endphp
<div class="field">
    <label for="{{ $id }}">{{ $label }} @if ($required)<span class="req" aria-hidden="true">*</span><span class="sr-only">(obligatorio)</span>@endif</label>
    <input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name, $value) }}"
           @required($required) aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}"
           aria-describedby="{{ $id }}-hint {{ $id }}-error" {{ $attributes }}>
    @if ($hint)<p class="hint" id="{{ $id }}-hint">{!! $hint !!}</p>@endif
    <p class="field__error" id="{{ $id }}-error">{{ $errors->first($name) }}</p>
</div>
