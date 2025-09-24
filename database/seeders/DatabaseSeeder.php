<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolSeeder::class,
            CategoriaSeeder::class,
            EspecialidadSeeder::class,
            UsuarioSeeder::class,
            MedicoSeeder::class,
            SecretariaSeeder::class,
            PacienteSeeder::class,
        ]);
    }
}
