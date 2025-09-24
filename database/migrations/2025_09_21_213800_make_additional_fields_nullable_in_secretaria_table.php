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
        Schema::table('secretaria', function (Blueprint $table) {
            $table->date('fecha_ingreso')->nullable()->change();
            $table->string('estado', 50)->nullable()->default('activo')->change();
            $table->string('correo', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('secretaria', function (Blueprint $table) {
            $table->date('fecha_ingreso')->nullable(false)->change();
            $table->string('estado', 50)->nullable(false)->change();
            $table->string('correo', 100)->nullable(false)->change();
        });
    }
};
