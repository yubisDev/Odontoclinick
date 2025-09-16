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
        Schema::create('medicos', function (Blueprint $table) {
            $table->integer('id_doctor', true);
            $table->string('nombre', 50);
            $table->string('apellidos', 50);
            $table->string('telefono', 15);
            $table->integer('id_usuario')->index('id_usuario');
            $table->integer('id_especialidad')->index('id_especialidad');
            $table->string('estado', 50);
            $table->string('correo', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};
