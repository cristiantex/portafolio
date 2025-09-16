<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProyectoFactory extends Factory
{
    public function definition(): array
    {
        $tecnologias = [ 'PHP', 'Laravel', 'Livewire', 'Vue.js', 'React', 'TailwindCSS', 'Bootstrap', 'MySQL', 'PostgreSQL',
            'Docker', 'AWS', 'Node.js', 'Python', 'Django', 'Redis', 'Git', 'GraphQL', 'TypeScript', 'Sass'];

        return [
            'titulo' => $this->faker->sentence(3),
            'descripcion' => $this->faker->paragraph(5),
            'url' => $this->faker->optional()->url(),
            'imagen' => null,
            'tecnologias' => implode(', ', $this->faker->randomElements($tecnologias, rand(3, 5))),
            'publicado' => $this->faker->boolean(80), // 80% publicados
        ];
    }
}
