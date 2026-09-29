<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:120',
            'email' => 'required|email|max:150',
            'mensaje' => 'required|string|min:10|max:2000',
            // Honeypot: un usuario real nunca lo completa.
            'sitio_web' => 'prohibited',
        ];
    }

    protected function getRedirectUrl(): string
    {
        return route('home').'#contacto';
    }
}
