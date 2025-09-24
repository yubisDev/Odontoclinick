<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categoria')->insert([
            ['nombre_categoria' => 'Ortodoncia', 'descripcion' => 'Tratamientos para alinear los dientes'],
            ['nombre_categoria' => 'Estética Dental', 'descripcion' => 'Blanqueamientos y carillas dentales'],
            ['nombre_categoria' => 'Endodoncia', 'descripcion' => 'Tratamientos de conducto'],
            ['nombre_categoria' => 'Odontología General', 'descripcion' => 'Consultas y limpiezas dentales'],
            ['nombre_categoria' => 'Implantes', 'descripcion' => 'Reemplazo de piezas dentales'],
        ]);
    }
}
