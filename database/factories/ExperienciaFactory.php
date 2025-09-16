<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienciaFactory extends Factory
{
    public function definition(): array
    {
        $empresas = ['Google', 'Microsoft', 'Amazon', 'Startup XYZ', 'Banco Nacional', 'Consultora ABC'];
        $cargos = ['Desarrollador Backend', 'Desarrollador Fullstack', 'Ingeniero de Software', 'Líder Técnico'];
        $tecnologias = [ 'PHP', 'Laravel', 'Livewire', 'Vue.js', 'React', 'TailwindCSS', 'Bootstrap', 'MySQL', 'PostgreSQL',
            'Docker', 'AWS', 'Node.js', 'Python', 'Django', 'Redis', 'Git', 'GraphQL', 'TypeScript', 'Sass'];

        return [
            'empresa' => $this->faker->randomElement($empresas),
            'cargo' => $this->faker->randomElement($cargos),
            'fecha_inicio' => $this->faker->dateTimeBetween('-10 years', '-1 year'),
            'fecha_fin' => $this->faker->boolean(70) ? $this->faker->dateTimeBetween('-1 year', 'now') : null,
            'descripcion' => $this->faker->paragraph(3),
            'tecnologias' => implode(', ', $this->faker->randomElements($tecnologias, rand(3, 5))),
            'logros' => $this->faker->boolean(50) ? $this->faker->sentence(6) : null,
        ];
    }
}
