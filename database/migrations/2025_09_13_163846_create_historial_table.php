<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('historial', function (Blueprint $table) {
            // Hacer id_cita opcional
            $table->integer('id_cita')->nullable()->change();

            // Agregar la relación foránea
            $table->foreign('id_cita')
                  ->references('id_cita')
                  ->on('citas')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('historial', function (Blueprint $table) {
            $table->dropForeign(['id_cita']);
            $table->integer('id_cita')->nullable(false)->change();
        });
    }
};

