<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SecretariaSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 3) as $i) {
            $idUsuario = DB::table('usuarios')->insertGetId([
                'nombre_usuario' => 'secretaria'.$i,
                'contraseña' => Hash::make('123456'),
                'id_rol' => 3, // Secretaria
                'estado' => 'activo',
            ]);

            DB::table('secretaria')->insert([
                'nombre' => 'Secretaria'.$i,
                'apellidos' => 'Apellido'.$i,
                'telefono' => '320'.rand(1000000,9999999),
                'fecha_ingreso' => Carbon::now()->subYears(rand(1,5)),
                'id_usuario' => $idUsuario,
                'estado' => 'activo',
                'correo' => 'secretaria'.$i.'@correo.com',
            ]);
        }
    }
}
