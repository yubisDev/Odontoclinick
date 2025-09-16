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
        Schema::table('historial', function (Blueprint $table) {
            $table->foreign(['id_paciente'], 'historial_ibfk_1')->references(['id_paciente'])->on('paciente')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_cita'], 'historial_ibfk_2')->references(['id_cita'])->on('citas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_doctor'], 'historial_ibfk_3')->references(['id_doctor'])->on('medicos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historial', function (Blueprint $table) {
            $table->dropForeign('historial_ibfk_1');
            $table->dropForeign('historial_ibfk_2');
            $table->dropForeign('historial_ibfk_3');
        });
    }
};
