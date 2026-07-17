<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumno;

class AsignaturaAlumnoSeeder extends Seeder
{
    public function run(): void
    {
        $asignaturasPorAlumno = [
            'A2024001' => [
                ['idAsignatura' => 1, 'Calificacion' => 9.2, 'FechaInscripcion' => '2025-02-01'],
                ['idAsignatura' => 2, 'Calificacion' => 8.7, 'FechaInscripcion' => '2025-02-02'],
            ],
            'A2024002' => [
                ['idAsignatura' => 2, 'Calificacion' => 9.5, 'FechaInscripcion' => '2025-02-03'],
                ['idAsignatura' => 3, 'Calificacion' => 8.0, 'FechaInscripcion' => '2025-02-04'],
            ],
            'A2024003' => [
                ['idAsignatura' => 1, 'Calificacion' => 8.9, 'FechaInscripcion' => '2025-02-05'],
                ['idAsignatura' => 4, 'Calificacion' => 9.8, 'FechaInscripcion' => '2025-02-06'],
            ],
            'A2024004' => [
                ['idAsignatura' => 3, 'Calificacion' => 8.3, 'FechaInscripcion' => '2025-02-07'],
                ['idAsignatura' => 5, 'Calificacion' => 9.0, 'FechaInscripcion' => '2025-02-08'],
            ],
        ];

        foreach ($asignaturasPorAlumno as $matricula => $asignaturas) {
            $alumno = Alumno::find($matricula);
            if (! $alumno) {
                continue;
            }

            foreach ($asignaturas as $asignatura) {
                $alumno->asignaturas()->syncWithoutDetaching([$asignatura['idAsignatura'] => [
                    'Calificacion' => $asignatura['Calificacion'],
                    'FechaInscripcion' => $asignatura['FechaInscripcion'],
                ]]);
            }
        }
    }
}
