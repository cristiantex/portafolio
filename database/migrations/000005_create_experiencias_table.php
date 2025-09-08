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
        Schema::create('experiencias', function (Blueprint $table) {
            $table->id();
            $table->string('empresa');
            $table->string('cargo');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable(); // null si es actual
            $table->text('descripcion')->nullable(); // resumen de tareas
            $table->json('tecnologias')->nullable(); // guardar array de ids de tecnologias
            $table->text('logros')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiencias');
    }
};
