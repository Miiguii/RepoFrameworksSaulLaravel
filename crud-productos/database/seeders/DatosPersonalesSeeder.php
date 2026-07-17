<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DatosPersonales;

class DatosPersonalesSeeder extends Seeder
{
    public function run(): void
    {
        $personas = [
            ['Nombre' => 'Juan', 'ApellidoPaterno' => 'Pérez', 'ApellidoMaterno' => 'García', 'FechaNacimiento' => '2000-01-15', 'idGenero' => 1, 'Telefono' => '5511122334', 'Email' => 'juan.perez@example.com', 'CURP' => 'PEGJ000115HDFRRL09', 'Calle' => 'Av. Universidad', 'NumE' => 101, 'idLocalidad' => 1, 'CP' => 44100],
            ['Nombre' => 'María', 'ApellidoPaterno' => 'López', 'ApellidoMaterno' => 'Martínez', 'FechaNacimiento' => '2001-05-20', 'idGenero' => 2, 'Telefono' => '5511223345', 'Email' => 'maria.lopez@example.com', 'CURP' => 'LOMM010520MNLPRT08', 'Calle' => 'Calle del Sol', 'NumE' => 25, 'idLocalidad' => 2, 'CP' => 45000],
            ['Nombre' => 'Carlos', 'ApellidoPaterno' => 'González', 'ApellidoMaterno' => 'Morales', 'FechaNacimiento' => '1999-08-03', 'idGenero' => 1, 'Telefono' => '5511334456', 'Email' => 'carlos.gonzalez@example.com', 'CURP' => 'GONM020803HDFRRA03', 'Calle' => 'Calle Hidalgo', 'NumE' => 78, 'idLocalidad' => 3, 'CP' => 64100],
            ['Nombre' => 'Fernanda', 'ApellidoPaterno' => 'Fernández', 'ApellidoMaterno' => 'Ramos', 'FechaNacimiento' => '2002-09-07', 'idGenero' => 2, 'Telefono' => '5511445567', 'Email' => 'fernanda.fernandez@example.com', 'CURP' => 'FERM150907MNLTRN06', 'Calle' => 'Av. Reforma', 'NumE' => 220, 'idLocalidad' => 4, 'CP' => 11500],
            ['Nombre' => 'Ramón', 'ApellidoPaterno' => 'Ramírez', 'ApellidoMaterno' => 'Jiménez', 'FechaNacimiento' => '1998-12-31', 'idGenero' => 1, 'Telefono' => '5511556678', 'Email' => 'ramon.ramirez@example.com', 'CURP' => 'RAMJ311299HDFRRL05', 'Calle' => 'Calle de la Luna', 'NumE' => 84, 'idLocalidad' => 5, 'CP' => 97000],
        ];
        
        foreach ($personas as $persona) {
            DatosPersonales::create($persona);
        }
    }
}