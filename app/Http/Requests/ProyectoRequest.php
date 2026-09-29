<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProyectoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:2000',
            'url' => 'nullable|url|max:500',
            'repositorio_url' => 'nullable|url|max:500',
            'imagen' => 'nullable|image|max:2048',
            'tecnologias' => 'nullable|string|max:255',
            'publicado' => 'nullable|boolean',
            'problema' => 'nullable|string|max:1500',
            'construccion' => 'nullable|string|max:1500',
            'arquitectura' => 'nullable|string|max:1500',
            'flujo' => 'nullable|string|max:500',
            'decisiones' => 'nullable|string|max:2000',
            'desafios' => 'nullable|string|max:1500',
            'resultado' => 'nullable|string|max:1500',
        ];
    }
}
