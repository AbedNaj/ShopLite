<?php

namespace Tests\Feature\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_register(): void
    {

        $response = $this->postJson('/api/v1/customer/register', [
            'email' => 'email@gmail.com',
            'name' => 'Customer User',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['user']);
    }


    public function test_customer_can_login()
    {

        $customerRole = Role::select('id')
            ->where('name', 'customer')
            ->first();


        $customer = User::factory()->create([
            'email' => 'customer@example.com',
            'name' => 'customer User',
            'password' => bcrypt('password'),
            'role_id' => $customerRole->id,
        ]);


        $response = $this->postJson('/api/v1/customer/login', [
            'email' => $customer['email'],
            'password' => 'password',
        ]);


        $response->assertStatus(200);
        $response->assertJsonStructure(['token', 'customer']);
    }
}
