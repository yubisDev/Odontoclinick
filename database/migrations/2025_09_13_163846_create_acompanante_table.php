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
        Schema::create('acompanante', function (Blueprint $table) {
            $table->integer('id_acompanante', true);
            $table->string('nombre', 50);
            $table->string('apellidos', 50);
            $table->string('parentesco', 50);
            $table->string('num_contacto', 15);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acompanante');
    }
};
