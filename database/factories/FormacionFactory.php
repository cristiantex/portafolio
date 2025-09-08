<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FormacionFactory extends Factory
{
    public function definition(): array
    {
        $instituciones = [
            'Universidad de Chile', 'Pontificia Universidad Católica',
            'MIT', 'Harvard', 'Platzi', 'Udemy', 'Coursera'
        ];

        $tipos = ['Carrera', 'Diplomado', 'Curso', 'Certificación'];

        return [
            'institucion' => $this->faker->randomElement($instituciones),
            'titulo' => $this->faker->sentence(3),
            'tipo' => $this->faker->randomElement($tipos),
            'fecha_inicio' => $this->faker->dateTimeBetween('-8 years', '-4 years'),
            'fecha_fin' => $this->faker->dateTimeBetween('-4 years', 'now'),
            'certificado_url' => $this->faker->boolean(40) ? $this->faker->url() : null,
        ];
    }
}
