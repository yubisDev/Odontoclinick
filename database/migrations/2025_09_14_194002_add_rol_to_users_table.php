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
        // Añade la columna 'rol' a la tabla 'users'
        Schema::table('users', function (Blueprint $table) {
            $table->string('rol')->default('paciente')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Elimina la columna 'rol' de la tabla 'users' si es necesario revertir
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rol');
        });
    }
};