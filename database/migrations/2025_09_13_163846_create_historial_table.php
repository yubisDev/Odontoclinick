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
        Schema::create('historial', function (Blueprint $table) {
            $table->integer('id_historial', true);
            $table->integer('id_paciente')->index('id_paciente');
            $table->integer('id_cita')->index('id_cita');
            $table->date('fecha');
            $table->text('procedimiento_realizado');
            $table->integer('id_doctor')->index('id_doctor');
            $table->text('diagnostico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial');
    }
};
