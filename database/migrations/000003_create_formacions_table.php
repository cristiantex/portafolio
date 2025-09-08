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
        Schema::create('formacion', function (Blueprint $table) {
            $table->id();
            $table->string('institucion');
            $table->string('titulo'); // carrera, curso, certificación
            $table->enum('tipo', ['Carrera', 'Diplomado', 'Curso', 'Certificación', 'Otro']);
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('certificado_url')->nullable(); // link al diploma/certificado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formacion');
    }
};
