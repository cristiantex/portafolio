<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->string('url')->nullable();           // enlace al proyecto o demo
            $table->string('imagen')->nullable();        // ruta imagen del proyecto
            $table->string('tecnologias')->nullable();   // ejemplo: "Laravel, Vue, MySQL"
            $table->boolean('publicado')->default(true); // visible o no en el portafolio
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
