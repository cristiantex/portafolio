<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TecnologiaFactory extends Factory
{
    public function definition(): array
    {
        $tecnologias = [ 'PHP', 'Laravel', 'Livewire', 'Vue.js', 'React', 'TailwindCSS', 'Bootstrap', 'MySQL', 'PostgreSQL',
            'Docker', 'AWS', 'Node.js', 'Python', 'Django', 'Redis', 'Git', 'GraphQL', 'TypeScript', 'Sass'];

        return [
            'nombre' => $this->faker->unique()->randomElement($tecnologias),
            'nivel' => $this->faker->randomElement(['Básico', 'Intermedio', 'Avanzado', 'Experto']),
            'experiencia_anios' => $this->faker->numberBetween(1, 10),
            'descripcion' => $this->faker->boolean(30) ? $this->faker->sentence(3) : null,
        ];
    }
}
