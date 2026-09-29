<?php

namespace Database\Seeders;

use App\Models\Experiencia;
use Illuminate\Database\Seeder;

class ExperienciaSeeder extends Seeder
{
    public function run(): void
    {
        Experiencia::create([
            'empresa' => 'Empresa del sector retail',
            'cargo' => 'Ingeniero de Software',
            'fecha_inicio' => '2021-03-01',
            'fecha_fin' => null,
            'descripcion' => 'Desarrollo y mantención de aplicaciones empresariales.',
            'contexto' => 'Aplicación existente con componentes legacy y procesos críticos de negocio.',
            'problema' => 'Mantener las funcionalidades en uso mientras se incorporan nuevas capacidades.',
            'solucion' => 'Migración progresiva de funcionalidades, separación de responsabilidades y desarrollo de nuevos módulos.',
            'logros' => null,
            'tecnologias' => 'Java, PHP, MySQL, Informix, Git',
        ]);

        Experiencia::create([
            'empresa' => 'Consultora de tecnología',
            'cargo' => 'Desarrollador Full Stack',
            'fecha_inicio' => '2018-06-01',
            'fecha_fin' => '2021-02-28',
            'descripcion' => 'Desarrollo de aplicaciones web a medida para distintos clientes.',
            'tecnologias' => 'PHP, JavaScript, jQuery, MySQL',
        ]);
    }
}
