<?php

namespace Tests\Feature\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderItemTest extends TestCase
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
    public function test_admin_can_create_item(): void
    {

        $user = $this->adminUser();

        $order = Order::factory()->create();
        $product = Product::factory()->create();
        $data = [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => '1',
            'price' => '100'
        ];
        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/admin/orderItems', $data);

        $response->assertStatus(201);
    }

    public function test_admin_can_delete_item(): void
    {

        $user = $this->adminUser();

        $orderItem = OrderItem::factory()->create();
        $response = $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/v1/admin/orderItems/{$orderItem['id']}");

        $response->assertStatus(200);
    }
    public function test_customer_cannot_create_item(): void
    {

        $user = $this->customerUser();

        $order = Order::factory()->create();
        $product = Product::factory()->create();
        $data = [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => '1',
            'price' => '100'
        ];
        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/admin/orderItems', $data);

        $response->assertStatus(403);
    }

    public function test_customer_cannot_delete_item(): void
    {

        $user = $this->customerUser();

        $orderItem = OrderItem::factory()->create();
        $response = $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/v1/admin/orderItems/{$orderItem['id']}");

        $response->assertStatus(403);
    }
}
