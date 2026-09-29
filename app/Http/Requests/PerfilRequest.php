<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfilRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // el acceso lo controla el middleware checkLogin
    }

    public function rules(): array
    {
        return [
            'alias' => 'required|string|max:50',
            'nombre' => 'required|string|max:100',
            'profesion' => 'nullable|string|max:100',
            'titular' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string|max:1500',
            'enfoque' => 'nullable|string|max:1500',
            'rumbo' => 'nullable|string|max:255',
            'ubicacion' => 'nullable|string|max:120',
            'email' => 'nullable|email|max:150',
            'telefono' => 'nullable|string|max:20',
            'linkedin' => 'nullable|url|max:150',
            'github' => 'nullable|url|max:150',
            'foto_perfil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cv' => 'nullable|file|mimes:pdf|max:5120',
        ];
    }

    public function attributes(): array
    {
        return [
            'foto_perfil' => 'foto',
            'cv' => 'CV',
        ];
    }
}
