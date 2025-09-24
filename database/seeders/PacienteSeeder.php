<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PacienteSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 10) as $i) {
            // 1. Crear usuario
            $idUsuario = DB::table('usuarios')->insertGetId([
                'nombre_usuario' => 'paciente'.$i,
                'contraseña' => Hash::make('123456'),
                'id_rol' => 4, // Paciente
                'estado' => 'activo',
            ]);

            // 2. Crear paciente asociado
            DB::table('paciente')->insert([
                'nombre' => 'Nombre'.$i,
                'apellidos' => 'Apellido'.$i,
                'fecha_nacimiento' => Carbon::now()->subYears(rand(15,50)),
                'correo' => 'paciente'.$i.'@correo.com',
                'direccion' => 'Calle '.$i.' #'.rand(1,50).'-'.rand(1,50),
                'fecha_registro' => Carbon::now(),
                'telefono' => '300'.rand(1000000,9999999),
                'id_usuario' => $idUsuario,
                'eps' => 'EPS'.rand(1,5),
                'rh' => ['O+','O-','A+','A-','B+','B-','AB+','AB-'][array_rand(['O+','O-','A+','A-','B+','B-','AB+','AB-'])],
                'estado' => 'activo',
            ]);
        }
    }
}
