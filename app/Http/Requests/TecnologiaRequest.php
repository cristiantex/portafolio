<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TecnologiaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'categoria' => ['nullable', Rule::in(config('portafolio.categorias_tecnologia'))],
            'nivel' => ['required', Rule::in(config('portafolio.niveles_tecnologia'))],
            'experiencia_anios' => 'nullable|integer|min:0|max:60',
            'descripcion' => 'nullable|string|max:1000',
        ];
    }
}
