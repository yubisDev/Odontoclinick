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
        Schema::create('inventario', function (Blueprint $table) {
            $table->integer('id_inventario', true);
            $table->integer('id_producto')->index('id_producto');
            $table->integer('cantidad_disponible');
            $table->integer('stock');
            $table->date('fecha_entrada');
            $table->date('fecha_salida')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario');
    }
};
