<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MedicoSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Traemos todas las especialidades y usuarios para asignar
        $especialidades = DB::table('especialidad')->pluck('id_especialidad')->toArray();
        $usuarios = DB::table('usuarios')->pluck('id_usuario')->toArray();

        // Creamos 10 médicos de prueba
        for ($i = 0; $i < 10; $i++) {
            DB::table('medicos')->insert([
                'nombre'         => $faker->firstName,
                'apellidos'      => $faker->lastName,
                'telefono'       => $faker->phoneNumber,
                'correo'         => $faker->unique()->safeEmail,
                'id_usuario'     => $faker->randomElement($usuarios), 
                'id_especialidad'=> $faker->randomElement($especialidades),
                'estado'         => $faker->randomElement(['activo','inactivo']),
            ]);
        }
    }
}
