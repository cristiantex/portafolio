<?php

/*
 * Mensajes de validación en español. Las reglas que no aparecen aquí
 * usan el texto en inglés del framework (fallback_locale).
 */
return [
    'required' => 'Este campo es obligatorio.',
    'string' => 'Debe ser un texto.',
    'email' => 'Escribe un correo electrónico válido.',
    'url' => 'Escribe una URL completa, por ejemplo https://ejemplo.com.',
    'date' => 'Escribe una fecha válida.',
    'integer' => 'Debe ser un número entero.',
    'boolean' => 'El valor no es válido.',
    'in' => 'La opción elegida no es válida.',
    'prohibited' => 'Este campo debe quedar vacío.',
    'after_or_equal' => 'Debe ser igual o posterior a :date.',
    'image' => 'El archivo debe ser una imagen.',
    'mimes' => 'El archivo debe ser de tipo: :values.',
    'file' => 'Debe ser un archivo.',
    'uploaded' => 'No se pudo subir el archivo.',

    'max' => [
        'string' => 'No puede superar los :max caracteres.',
        'numeric' => 'No puede ser mayor que :max.',
        'file' => 'El archivo no puede superar los :max KB.',
    ],
    'min' => [
        'string' => 'Debe tener al menos :min caracteres.',
        'numeric' => 'No puede ser menor que :min.',
    ],

    'attributes' => [
        'titulo' => 'título',
        'descripcion' => 'descripción',
        'tecnologias' => 'tecnologías',
        'fecha_inicio' => 'fecha de inicio',
        'fecha_fin' => 'fecha de término',
        'institucion' => 'institución',
        'certificado_url' => 'URL del certificado',
        'repositorio_url' => 'URL del repositorio',
        'experiencia_anios' => 'años de experiencia',
        'categoria' => 'categoría',
        'nombre' => 'nombre',
        'mensaje' => 'mensaje',
        'password' => 'contraseña',
        'user' => 'usuario',
    ],
];
