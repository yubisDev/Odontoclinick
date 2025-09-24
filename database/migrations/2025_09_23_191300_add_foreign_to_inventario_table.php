<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('inventario', function (Blueprint $table) {
            // Aseguramos que id_producto sea del mismo tipo que en productos (int unsigned)
            $table->unsignedInteger('id_producto')->change();

            $table->foreign('id_producto')
                  ->references('id_producto')
                  ->on('productos')
                  ->onDelete('cascade'); // si eliminas un producto, elimina inventario asociado
        });
    }

    public function down()
    {
        Schema::table('inventario', function (Blueprint $table) {
            $table->dropForeign(['id_producto']);
        });
    }
};
