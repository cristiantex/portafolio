<?php

return [

    /*
    | Credenciales del mantenedor. Se leen aquí (y no con env() en el código)
    | para que funcionen con `php artisan config:cache`.
    | Define LOGIN_PASS_HASH (bcrypt) en producción; LOGIN_PASS queda como alternativa simple.
    */
    'login' => [
        'user' => env('LOGIN_USER'),
        'pass' => env('LOGIN_PASS'),
        'pass_hash' => env('LOGIN_PASS_HASH'),
    ],

    // Categorías con las que se agrupan las tecnologías en la web pública (orden de aparición).
    'categorias_tecnologia' => [
        'Backend',
        'Frontend',
        'Bases de datos',
        'Arquitectura e ingeniería',
        'DevOps e infraestructura',
        'IA',
        'Otras',
    ],

    'niveles_tecnologia' => ['Básico', 'Intermedio', 'Avanzado', 'Experto'],

    'tipos_formacion' => ['Carrera', 'Diplomado', 'Curso', 'Certificación', 'Otro'],
];
