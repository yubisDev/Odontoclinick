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
        Schema::table('medicos', function (Blueprint $table) {
            $table->foreign(['id_usuario'], 'medicos_ibfk_1')->references(['id_usuario'])->on('usuarios')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_especialidad'], 'medicos_ibfk_2')->references(['id_especialidad'])->on('especialidad')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicos', function (Blueprint $table) {
            $table->dropForeign('medicos_ibfk_1');
            $table->dropForeign('medicos_ibfk_2');
        });
    }
};
