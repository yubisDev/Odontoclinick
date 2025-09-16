<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre_usuario')->unique();
            $table->string('contraseña'); // para hashed passwords
            $table->tinyInteger('id_rol'); // 1=admin, 2=medico, 3=secretaria, 4=paciente
            $table->boolean('estado')->default(1); // 1=activo, 0=inactivo
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
