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
        Schema::table('uso_producto_tratamiento', function (Blueprint $table) {
            $table->foreign(['id_tratamiento'], 'uso_producto_tratamiento_ibfk_1')->references(['id_tratamiento'])->on('tratamientos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_producto'], 'uso_producto_tratamiento_ibfk_2')->references(['id_producto'])->on('productos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('uso_producto_tratamiento', function (Blueprint $table) {
            $table->dropForeign('uso_producto_tratamiento_ibfk_1');
            $table->dropForeign('uso_producto_tratamiento_ibfk_2');
        });
    }
};
