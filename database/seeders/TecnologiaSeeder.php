<?php

namespace Database\Seeders;

use App\Models\Tecnologia;
use Illuminate\Database\Seeder;

class TecnologiaSeeder extends Seeder
{
    public function run(): void
    {
        $filas = [
            // categoría, nombre, nivel, años, uso
            ['Backend', 'Java / Spring Boot', 'Avanzado', null, 'APIs, servicios empresariales y evolución de aplicaciones existentes.'],
            ['Backend', 'PHP / Laravel', 'Avanzado', null, 'Aplicaciones web con panel de administración, validación y control de acceso.'],
            ['Frontend', 'JavaScript', 'Avanzado', null, 'Interfaces web y comportamiento en el cliente.'],
            ['Frontend', 'jQuery', 'Avanzado', null, 'Mantención y evolución de interfaces en aplicaciones existentes.'],
            ['Bases de datos', 'MySQL', 'Avanzado', null, 'Modelado, consultas y migraciones de esquema.'],
            ['Bases de datos', 'Oracle', 'Intermedio', null, 'Integración de aplicaciones con bases de datos corporativas.'],
            ['Bases de datos', 'Informix', 'Intermedio', null, 'Acceso a sistemas legacy durante procesos de migración.'],
            ['Arquitectura e ingeniería', 'Git', 'Avanzado', null, 'Control de versiones y trabajo por ramas.'],
            ['Arquitectura e ingeniería', 'Integración de sistemas', 'Avanzado', null, 'Conexión entre aplicaciones nuevas y sistemas existentes.'],
        ];

        foreach ($filas as [$categoria, $nombre, $nivel, $anios, $uso]) {
            Tecnologia::create([
                'categoria' => $categoria, 'nombre' => $nombre, 'nivel' => $nivel,
                'experiencia_anios' => $anios, 'descripcion' => $uso,
            ]);
        }
    }
}
