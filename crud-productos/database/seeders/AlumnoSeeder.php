<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumno;
use App\Models\DatosPersonales;

class AlumnoSeeder extends Seeder
{
    public function run(): void
    {
        $juan = DatosPersonales::where('Nombre', 'Juan')->where('ApellidoPaterno', 'Pérez')->first();
        $maria = DatosPersonales::where('Nombre', 'María')->where('ApellidoPaterno', 'López')->first();
        $carlos = DatosPersonales::where('Nombre', 'Carlos')->where('ApellidoPaterno', 'González')->first();
        $ramon = DatosPersonales::where('Nombre', 'Ramón')->where('ApellidoPaterno', 'Ramírez')->first();

        if ($juan) {
            Alumno::firstOrCreate([
                'Matricula' => 'A2024001',
            ], [
                'IdCarrera' => 1,
                'IdDatosP' => $juan->IdDatosP,
                'Status' => 'A',
            ]);
        }

        if ($maria) {
            Alumno::firstOrCreate([
                'Matricula' => 'A2024002',
            ], [
                'IdCarrera' => 2,
                'IdDatosP' => $maria->IdDatosP,
                'Status' => 'A',
            ]);
        }

        if ($carlos) {
            Alumno::firstOrCreate([
                'Matricula' => 'A2024003',
            ], [
                'IdCarrera' => 3,
                'IdDatosP' => $carlos->IdDatosP,
                'Status' => 'G',
            ]);
        }

        if ($ramon) {
            Alumno::firstOrCreate([
                'Matricula' => 'A2024004',
            ], [
                'IdCarrera' => 1,
                'IdDatosP' => $ramon->IdDatosP,
                'Status' => 'A',
            ]);
        }
    }
}