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
        Schema::create('perfil', function (Blueprint $table) {
            $table->id();
            $table->string('alias');
            $table->string('nombre');
            $table->string('profesion')->nullable();      // Ej: Ingeniero de Software
            $table->text('descripcion')->nullable();      // "Sobre mí"
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->string('foto_perfil')->nullable();    // ruta a la imagen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfil');
    }
};
