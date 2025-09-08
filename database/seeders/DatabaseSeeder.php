<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        \App\Models\Perfil::factory()->create(); // Solo 1 perfil
        \App\Models\Proyecto::factory(8)->create(); // 8 proyectos de prueba
        \App\Models\Tecnologia::factory(10)->create();
        \App\Models\Experiencia::factory(5)->create();
        \App\Models\Formacion::factory(5)->create();
    }
}
