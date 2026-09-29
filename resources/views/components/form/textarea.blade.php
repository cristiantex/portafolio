@props(['name', 'label', 'value' => null, 'rows' => 4, 'max' => null, 'hint' => null, 'required' => false])
@php $id = 'f-'.$name; @endphp
<div class="field">
    <label for="{{ $id }}">{{ $label }} @if ($required)<span class="req" aria-hidden="true">*</span>@endif</label>
    <textarea id="{{ $id }}" name="{{ $name }}" rows="{{ $rows }}" @if ($max) maxlength="{{ $max }}" @endif
              @required($required) aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}"
              aria-describedby="{{ $id }}-hint {{ $id }}-error">{{ old($name, $value) }}</textarea>
    @if ($max)<p class="counter" id="{{ $id }}-counter" aria-hidden="true"></p>@endif
    @if ($hint)<p class="hint" id="{{ $id }}-hint">{!! $hint !!}</p>@endif
    <p class="field__error" id="{{ $id }}-error">{{ $errors->first($name) }}</p>
</div>
