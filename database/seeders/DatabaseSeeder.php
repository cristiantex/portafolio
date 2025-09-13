<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Perfil::factory()->create();
        \App\Models\Proyecto::factory(9)->create();
        \App\Models\Tecnologia::factory(12)->create();
        \App\Models\Experiencia::factory(6)->create();
        \App\Models\Formacion::factory(6)->create();
    }
}