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
        Schema::create('paciente', function (Blueprint $table) {
            $table->integer('id_paciente', true);
            $table->string('nombre', 50);
            $table->string('apellidos', 50);
            $table->date('fecha_nacimiento');
            $table->string('correo', 100);
            $table->string('direccion');
            $table->date('fecha_registro');
            $table->string('telefono', 15);
            $table->integer('id_acompanante')->nullable()->index('id_acompanante');
            $table->integer('id_usuario')->index('id_usuario');
            $table->string('eps', 50);
            $table->string('rh', 5);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paciente');
    }
};
