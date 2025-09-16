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
        Schema::create('uso_producto_tratamiento', function (Blueprint $table) {
            $table->integer('id_uso_producto_tratamiento', true);
            $table->integer('id_tratamiento')->index('id_tratamiento');
            $table->integer('id_producto')->index('id_producto');
            $table->decimal('cantidad_uso', 10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uso_producto_tratamiento');
    }
};
