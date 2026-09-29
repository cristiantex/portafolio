<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Datos de ejemplo para desarrollo local. Sirven para ver el sitio completo;
 * el contenido real se carga desde el mantenedor. No corre en producción.
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->isProduction()) {
            $this->command?->warn('DatabaseSeeder omitido: contiene datos de ejemplo y no debe correr en producción.');

            return;
        }

        $this->call([
            PerfilSeeder::class,
            TecnologiaSeeder::class,
            ExperienciaSeeder::class,
            FormacionSeeder::class,
            ProyectoSeeder::class,
        ]);
    }
}
