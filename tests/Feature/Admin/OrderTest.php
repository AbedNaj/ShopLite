<?php

namespace Tests\Feature\Admin;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    private function adminUser()
    {
        $adminRole = Role::where('name', 'admin')->first();
        return User::factory()->create([
            'email' => fake()->safeEmail(),
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);
    }

    private function customerUser()
    {
        $adminRole = Role::where('name', 'customer')->first();
        return User::factory()->create([
            'email' => fake()->safeEmail(),
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);
    }
    public function test_admin_can_create_order(): void
    {

        $user = $this->adminUser();

        $customer = Customer::factory()->create();

        $data = [
            'price' => '150',
            'customer_id' => $customer['id'],
            'shipping_address' => 'address'
        ];
        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/admin/orders', $data);

        $response->assertStatus(201);
    }


    public function test_admin_can_update_order(): void
    {

        $user = $this->adminUser();

        $order = Order::factory()->create();

        $data = [

            'shipping_address' => 'newAddress'
        ];
        $response = $this->actingAs($user, 'sanctum')
            ->putJson("/api/v1/admin/orders/{$order['id']}", $data);

        $response->assertStatus(200);
    }

    public function test_admin_can_delete_order(): void
    {

        $user = $this->adminUser();

        $order = Order::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/v1/admin/orders/{$order['id']}");

        $response->assertStatus(200);
    }

    public function test_customer_cannot_create_order(): void
    {

        $user = $this->customerUser();

        $customer = Customer::factory()->create();

        $data = [
            'price' => '150',
            'customer_id' => $customer['id'],
            'shipping_address' => 'address'
        ];
        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/admin/orders', $data);

        $response->assertStatus(403);
    }


    public function test_customer_cannot_update_order(): void
    {


        $user = $this->customerUser();
        $order = Order::factory()->create();

        $data = [

            'shipping_address' => 'newAddress'
        ];
        $response = $this->actingAs($user, 'sanctum')
            ->putJson("/api/v1/admin/orders/{$order['id']}", $data);

        $response->assertStatus(403);
    }

    public function test_customer_cannot_delete_order(): void
    {


        $user = $this->customerUser();

        $order = Order::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/v1/admin/orders/{$order['id']}");

        $response->assertStatus(403);
    }
}
