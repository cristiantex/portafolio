@props(['name', 'label', 'options' => [], 'value' => null, 'required' => false, 'placeholder' => null, 'hint' => null])
@php $id = 'f-'.$name; $actual = old($name, $value); @endphp
<div class="field">
    <label for="{{ $id }}">{{ $label }} @if ($required)<span class="req" aria-hidden="true">*</span>@endif</label>
    <select id="{{ $id }}" name="{{ $name }}" @required($required) aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}"
            aria-describedby="{{ $id }}-hint {{ $id }}-error">
        @if ($placeholder !== null)<option value="">{{ $placeholder }}</option>@endif
        @foreach ($options as $opcion)
            <option value="{{ $opcion }}" @selected($actual === $opcion)>{{ $opcion }}</option>
        @endforeach
    </select>
    @if ($hint)<p class="hint" id="{{ $id }}-hint">{!! $hint !!}</p>@endif
    <p class="field__error" id="{{ $id }}-error">{{ $errors->first($name) }}</p>
</div>
