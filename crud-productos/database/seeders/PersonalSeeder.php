<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Personal;
use App\Models\TipoPersonal;
use App\Models\DatosPersonales;

class PersonalSeeder extends Seeder
{
    public function run(): void
    {
        $docenteTipo = TipoPersonal::firstOrCreate(['Nombre' => 'Docente']);
        $administrativoTipo = TipoPersonal::firstOrCreate(['Nombre' => 'Administrativo']);
        $directivoTipo = TipoPersonal::firstOrCreate(['Nombre' => 'Directivo']);

        $juan = DatosPersonales::where('Nombre', 'Juan')->where('ApellidoPaterno', 'Pérez')->first();
        $maria = DatosPersonales::where('Nombre', 'María')->where('ApellidoPaterno', 'López')->first();
        $carlos = DatosPersonales::where('Nombre', 'Carlos')->where('ApellidoPaterno', 'González')->first();

        if ($juan) {
            Personal::firstOrCreate([
                'ClaveEmp' => 'EMP001',
            ], [
                'IdDatosP' => $juan->IdDatosP,
                'IdTipo' => $docenteTipo->idTipo,
                'Status' => true,
            ]);
        }

        if ($maria) {
            Personal::firstOrCreate([
                'ClaveEmp' => 'EMP002',
            ], [
                'IdDatosP' => $maria->IdDatosP,
                'IdTipo' => $administrativoTipo->idTipo,
                'Status' => true,
            ]);
        }

        if ($carlos) {
            Personal::firstOrCreate([
                'ClaveEmp' => 'EMP003',
            ], [
                'IdDatosP' => $carlos->IdDatosP,
                'IdTipo' => $directivoTipo->idTipo,
                'Status' => true,
            ]);
        }
    }
}