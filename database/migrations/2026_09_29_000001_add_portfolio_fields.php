<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Campos opcionales que permiten presentar el portafolio como currículum técnico.
 * Todos son nullable: los registros existentes no cambian y la web pública
 * solo muestra lo que se complete desde el mantenedor.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perfil', function (Blueprint $table) {
            $table->string('titular', 255)->nullable()->after('profesion');   // afirmación corta del hero
            $table->text('enfoque')->nullable()->after('descripcion');        // problemas que resuelve, separados por ;
            $table->string('rumbo', 255)->nullable()->after('enfoque');       // hacia dónde evoluciona el perfil
            $table->string('ubicacion', 120)->nullable()->after('rumbo');
            $table->string('cv')->nullable()->after('foto_perfil');           // ruta del PDF en disco public
        });

        Schema::table('tecnologias', function (Blueprint $table) {
            $table->string('categoria', 40)->nullable()->after('nombre');
        });

        Schema::table('experiencias', function (Blueprint $table) {
            $table->text('contexto')->nullable()->after('descripcion');
            $table->text('problema')->nullable()->after('contexto');
            $table->text('solucion')->nullable()->after('problema');
        });

        Schema::table('proyectos', function (Blueprint $table) {
            $table->string('repositorio_url', 500)->nullable()->after('url');
            $table->text('problema')->nullable()->after('descripcion');
            $table->text('construccion')->nullable()->after('problema');      // qué se construyó
            $table->text('arquitectura')->nullable()->after('construccion');
            $table->string('flujo', 500)->nullable()->after('arquitectura');  // "A > B > C" para el diagrama
            $table->text('decisiones')->nullable()->after('flujo');           // separadas por ;
            $table->text('desafios')->nullable()->after('decisiones');
            $table->text('resultado')->nullable()->after('desafios');
        });
    }

    public function down(): void
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropColumn(['repositorio_url', 'problema', 'construccion', 'arquitectura', 'flujo', 'decisiones', 'desafios', 'resultado']);
        });
        Schema::table('experiencias', function (Blueprint $table) {
            $table->dropColumn(['contexto', 'problema', 'solucion']);
        });
        Schema::table('tecnologias', function (Blueprint $table) {
            $table->dropColumn('categoria');
        });
        Schema::table('perfil', function (Blueprint $table) {
            $table->dropColumn(['titular', 'enfoque', 'rumbo', 'ubicacion', 'cv']);
        });
    }
};
