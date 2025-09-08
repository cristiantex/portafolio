<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProyectoFactory extends Factory
{
    public function definition(): array
    {
        $tecnologias = [
            'Laravel', 'Livewire', 'Vue.js', 'React',
            'TailwindCSS', 'Bootstrap', 'MySQL', 'PostgreSQL',
            'Docker', 'AWS'
        ];

        return [
            'titulo' => $this->faker->sentence(3),
            'descripcion' => $this->faker->paragraph(5),
            'url' => $this->faker->optional()->url(),
            'imagen' => $this->faker->optional()->imageUrl(800, 600, 'tech', true, 'proyecto'),
            'tecnologias' => implode(', ', $this->faker->randomElements($tecnologias, rand(2, 5))),
            'publicado' => $this->faker->boolean(80), // 80% publicados
        ];
    }
}
