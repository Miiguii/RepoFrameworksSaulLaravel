<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeders::class,
            GeneroSeeder::class,
            EstadoSeeder::class,
            MunicipioSeeder::class,
            LocalidadSeeder::class,
            TipoPersonalSeeder::class,
            CarreraSeeder::class,
            AsignaturaSeeder::class,
            EscuelaSeeder::class,
            DatosPersonalesSeeder::class,
            AlumnoSeeder::class,
            AsignaturaAlumnoSeeder::class,
            PersonalSeeder::class,
            HorarioSeeder::class,
            HorarioPersonalSeeder::class,
        ]);
    }
}