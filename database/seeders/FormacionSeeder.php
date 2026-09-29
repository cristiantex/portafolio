<?php

namespace Database\Seeders;

use App\Models\Formacion;
use Illuminate\Database\Seeder;

class FormacionSeeder extends Seeder
{
    public function run(): void
    {
        Formacion::create([
            'institucion' => 'Universidad',
            'titulo' => 'Ingeniería en Informática',
            'tipo' => 'Carrera',
            'fecha_inicio' => '2011-03-01',
            'fecha_fin' => '2015-12-01',
        ]);
    }
}
