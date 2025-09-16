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
        Schema::table('citas_tratamientos', function (Blueprint $table) {
            $table->foreign(['id_cita'], 'citas_tratamientos_ibfk_1')->references(['id_cita'])->on('citas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_tratamiento'], 'citas_tratamientos_ibfk_2')->references(['id_tratamiento'])->on('tratamientos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citas_tratamientos', function (Blueprint $table) {
            $table->dropForeign('citas_tratamientos_ibfk_1');
            $table->dropForeign('citas_tratamientos_ibfk_2');
        });
    }
};
