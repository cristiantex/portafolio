<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PerfilFactory extends Factory
{
    public function definition(): array
    {
        return [
            'alias' => $this->faker->firstName().' DEV',
            'nombre' => $this->faker->name(),
            'profesion' => $this->faker->randomElement([
                'Ingeniero de Software',
                'Desarrollador Backend',
                'Desarrollador Fullstack',
                'Arquitecto de Software',
                'Consultor TI'
            ]),
            'descripcion' => 'Soy ingeniero de desarrollo de software con experiencia en aplicaciones web, microservicios, integración con bases de datos y optimización de procesos. Me especializo en PHP, Java, Spring Boot, Oracle, MySQL y front-end con jQuery. Apasionado por aprender nuevas tecnologías y liderar proyectos de transformación digital.',
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->optional()->phoneNumber(),
            'linkedin' => $this->faker->optional()->url(),
            'github' => 'https://github.com/' . $this->faker->userName(),
            'foto_perfil' => 'https://cdn-icons-png.flaticon.com/512/12225/12225881.png'
        ];
    }
}
