<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rol')->insert([
            ['nombre_rol' => 'Administrador'],
            ['nombre_rol' => 'Médico'],
            ['nombre_rol' => 'Secretaria'],
            ['nombre_rol' => 'Paciente'],
        ]);
    }
}
