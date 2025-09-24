<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadSeeder extends Seeder
{
    public function run(): void
    {
        $especialidades = [
            'Odontología General',
            'Ortodoncia',
            'Endodoncia',
            'Periodoncia',
            'Implantología',
            'Odontopediatría',
            'Cirugía Oral y Maxilofacial',
            'Rehabilitación Oral',
            'Estética Dental',
            'Patología Oral'
        ];

        foreach ($especialidades as $nombre) {
            DB::table('especialidad')->insert([
                'nombre_especialidad' => $nombre
            ]);
        }
    }
}
