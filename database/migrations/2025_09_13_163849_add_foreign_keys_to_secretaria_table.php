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
            $table->foreign(['id_usuario'], 'secretaria_ibfk_1')->references(['id_usuario'])->on('usuarios')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('secretaria', function (Blueprint $table) {
            $table->dropForeign('secretaria_ibfk_1');
        });
    }
};
