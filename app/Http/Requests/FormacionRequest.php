<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'institucion' => 'required|string|max:255',
            'titulo' => 'required|string|max:255',
            'tipo' => ['required', Rule::in(config('portafolio.tipos_formacion'))],
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'certificado_url' => 'nullable|url|max:500',
        ];
    }
}
