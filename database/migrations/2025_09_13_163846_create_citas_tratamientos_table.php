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
        Schema::create('citas_tratamientos', function (Blueprint $table) {
            $table->integer('id_cita');
            $table->integer('id_tratamiento')->index('id_tratamiento');
            $table->text('observaciones')->nullable();

            $table->primary(['id_cita', 'id_tratamiento']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas_tratamientos');
    }
};
