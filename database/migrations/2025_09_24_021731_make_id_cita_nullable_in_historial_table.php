<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('historial', function (Blueprint $table) {
            $table->foreignId('id_cita')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('historial', function (Blueprint $table) {
            $table->foreignId('id_cita')->change();
        });
    }
};
