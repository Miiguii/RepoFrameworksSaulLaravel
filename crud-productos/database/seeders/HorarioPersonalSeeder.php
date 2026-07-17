<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Personal;

class HorarioPersonalSeeder extends Seeder
{
    public function run(): void
    {
        $asignaciones = [
            ['IdPersonal' => 1, 'idHorario' => 1],
            ['IdPersonal' => 1, 'idHorario' => 3],
            ['IdPersonal' => 2, 'idHorario' => 2],
            ['IdPersonal' => 3, 'idHorario' => 1],
        ];

        foreach ($asignaciones as $asignacion) {
            $personal = Personal::find($asignacion['IdPersonal']);
            if (! $personal) {
                continue;
            }

            $personal->horarios()->syncWithoutDetaching([$asignacion['idHorario']]);
        }
    }
}
