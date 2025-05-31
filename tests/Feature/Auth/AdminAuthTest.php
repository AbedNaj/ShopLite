<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_login_successfully()
    {

        $adminRole = Role::select('id')
            ->where('name', 'admin')
            ->first();


        $admin = User::factory()->create([
            'id' => Str::ulid(),
            'email' => 'admin@example.com',
            'name' => 'Admin User',
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);


        $response = $this->postJson('/api/v1/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);


        $response->assertStatus(200);
        $response->assertJsonStructure(['token', 'admin']);
    }
}
