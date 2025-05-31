<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Str;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_admin_can_create_category(): void
    {


        $adminRole = Role::where('name', 'admin')->first();
        $user = User::factory()->create([

            'email' => fake()->safeEmail(),
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);
        $data = [
            'name' => 'Test Category',
            'description' => 'This is a test category.',
            'image' => null,
        ];

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/admin/categories', $data);

        $response->assertStatus(201);
    }

    public function test_admin_can_update_category(): void
    {


        $adminRole = Role::where('name', 'admin')->first();
        $user = User::factory()->create([

            'email' => fake()->safeEmail(),
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);

        $category =   Category::factory()->create([
            'name' => 'Old Category Name',
            'description' => 'This is an old category description.',
            'image' => null,
        ]);
        $response = $this->actingAs($user, 'sanctum')
            ->putJson("/api/v1/admin/categories/{$category->id}", [
                'name' => 'Updated Category Name',
                'description' => 'This is an updated category description.',
                'image' => null,
            ]);

        $response->assertStatus(200);
    }
    public function test_admin_can_delete_category(): void
    {


        $adminRole = Role::where('name', 'admin')->first();
        $user = User::factory()->create([

            'email' => fake()->safeEmail(),
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);

        $category =   Category::factory()->create([
            'name' => 'Old Category Name',
            'description' => 'This is an old category description.',
            'image' => null,
        ]);
        $response = $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/v1/admin/categories/{$category->id}");

        $response->assertStatus(200);
    }
    public function test_customer_cannot_create_category(): void
    {


        $customerRole  = Role::where('name', 'customer')->first();
        $user = User::factory()->create([

            'email' => fake()->safeEmail(),
            'password' => bcrypt('password'),
            'role_id' => $customerRole->id,
        ]);
        $data = [
            'name' => 'Test Category',
            'description' => 'This is a test category.',
            'image' => null,
        ];

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/admin/categories', $data);

        $response->assertStatus(403);
    }


    public function test_customer_cannot_update_category(): void
    {


        $customerRole = Role::where('name', 'customer')->first();
        $user = User::factory()->create([

            'email' => fake()->safeEmail(),
            'password' => bcrypt('password'),
            'role_id' => $customerRole->id,
        ]);

        $category =   Category::factory()->create([
            'name' => 'Old Category Name',
            'description' => 'This is an old category description.',
            'image' => null,
        ]);
        $response = $this->actingAs($user, 'sanctum')
            ->putJson("/api/v1/admin/categories/{$category->id}", [
                'name' => 'Updated Category Name',
                'description' => 'This is an updated category description.',
                'image' => null,
            ]);

        $response->assertStatus(403);
    }
    public function test_customer_cannot_delete_category(): void
    {


        $customerRole = Role::where('name', 'customer')->first();
        $user = User::factory()->create([

            'email' => fake()->safeEmail(),
            'password' => bcrypt('password'),
            'role_id' => $customerRole->id,
        ]);

        $category =   Category::factory()->create([
            'name' => 'Old Category Name',
            'description' => 'This is an old category description.',
            'image' => null,
        ]);
        $response = $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/v1/admin/categories/{$category->id}");

        $response->assertStatus(403);
    }
}
