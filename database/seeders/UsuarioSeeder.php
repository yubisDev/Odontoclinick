<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('usuario')->insert([
            'nombre_usuario' => 'admin',
            'nombre' => 'Super',
            'apellidos' => 'Administrador',
            'correo' => 'admin@odontoclinik.com',
            'password' => Hash::make('123456'),
            'id_rol' => 1, // Administrador
        ]);
    }
}
