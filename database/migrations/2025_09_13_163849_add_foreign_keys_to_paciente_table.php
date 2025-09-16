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
        Schema::table('paciente', function (Blueprint $table) {
            $table->foreign(['id_acompanante'], 'paciente_ibfk_1')->references(['id_acompanante'])->on('acompanante')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_usuario'], 'paciente_ibfk_2')->references(['id_usuario'])->on('usuarios')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paciente', function (Blueprint $table) {
            $table->dropForeign('paciente_ibfk_1');
            $table->dropForeign('paciente_ibfk_2');
        });
    }
};
