<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeders extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('tipo', 'Administrador')->first();
        $userRole = Role::where('tipo', 'Usuario')->first();

        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password123'),
                'role_id' => $adminRole?->id,
            ]
        );

        User::updateOrCreate(
            ['email' => 'usuario@example.com'],
            [
                'name' => 'Usuario Normal',
                'password' => Hash::make('password123'),
                'role_id' => $userRole?->id,
            ]
        );
    }
}
