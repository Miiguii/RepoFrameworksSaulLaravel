<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_user_with_a_selected_role(): void
    {
        $adminRole = Role::firstOrCreate(['tipo' => 'Administrador']);
        $userRole = Role::firstOrCreate(['tipo' => 'Usuario']);

        $admin = User::factory()->create(['role_id' => $adminRole->id]);

        $this->actingAs($admin);

        $response = $this->post('/admin/users', [
            'name' => 'Nuevo Usuario',
            'email' => 'nuevo@ejemplo.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role_id' => $userRole->id,
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'email' => 'nuevo@ejemplo.com',
            'role_id' => $userRole->id,
        ]);
    }
}
