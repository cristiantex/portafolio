<?php

namespace Database\Seeders;

use App\Models\Perfil;
use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    public function run(): void
    {
        Perfil::create([
            'alias' => 'Cristian Tambley',
            'nombre' => 'Cristian Tambley M.',
            'profesion' => 'Ingeniero de Software',
            'titular' => 'Desarrollo y evolución de sistemas empresariales, desde aplicaciones legacy hasta arquitecturas modernas.',
            'descripcion' => 'Ingeniero de desarrollo de software con experiencia en aplicaciones web, microservicios, integración con bases de datos y optimización de procesos. Trabajo con PHP, Java, Spring Boot, Oracle, MySQL y front-end con jQuery.',
            'enfoque' => 'Modernización de aplicaciones existentes sin detener la operación; Integración entre sistemas y bases de datos; Diseño de componentes y separación de responsabilidades',
            'rumbo' => 'Arquitectura de software y de soluciones, con foco en ingeniería de IA.',
            'ubicacion' => 'Chile',
            'email' => 'cristiantex@gmail.com',
            'github' => 'https://github.com/cristiantex',
        ]);
    }
}
