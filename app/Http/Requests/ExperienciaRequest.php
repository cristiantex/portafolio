<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienciaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'empresa' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'descripcion' => 'nullable|string|max:2000',
            'contexto' => 'nullable|string|max:1500',
            'problema' => 'nullable|string|max:1500',
            'solucion' => 'nullable|string|max:1500',
            'tecnologias' => 'nullable|string|max:255',
            'logros' => 'nullable|string|max:2000',
        ];
    }
}
