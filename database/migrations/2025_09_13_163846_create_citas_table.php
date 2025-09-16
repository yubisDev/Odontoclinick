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
        Schema::create('citas', function (Blueprint $table) {
            $table->integer('id_cita', true);
            $table->integer('id_paciente')->index('id_paciente');
            $table->integer('id_horario')->index('id_horario');
            $table->dateTime('fecha_horario');
            $table->string('estado', 50);
            $table->text('notas')->nullable();
            $table->integer('id_doctor')->index('id_doctor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
