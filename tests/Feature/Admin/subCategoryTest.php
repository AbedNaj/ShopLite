<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Role;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubCategoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;



    public function test_admin_can_create_subCategory(): void
    {
        $admin = $this->createUserWithRole('admin');
        $category = $this->createCategory();

        $data = [
            'name' => 'Test SubCategory',
            'category_id' => $category->id,
            'image' => null,
        ];

        $response = $this->actingAs($admin, 'sanctum')
            ->postJson('/api/v1/admin/subCategories', $data);

        $response->assertStatus(201);
    }

    public function test_admin_can_update_subCategory(): void
    {
        $admin = $this->createUserWithRole('admin');
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category);

        $data = [
            'name' => 'Updated Category Name',
            'category_id' => $category->id,
            'image' => null,
        ];

        $response = $this->actingAs($admin, 'sanctum')
            ->putJson("/api/v1/admin/subCategories/{$subCategory->id}", $data);

        $response->assertStatus(200);
    }

    public function test_admin_can_delete_subCategory(): void
    {
        $admin = $this->createUserWithRole('admin');
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category);

        $response = $this->actingAs($admin, 'sanctum')
            ->deleteJson("/api/v1/admin/subCategories/{$subCategory->id}");

        $response->assertStatus(200);
    }

    public function test_customer_cannot_create_subCategory(): void
    {
        $customer = $this->createUserWithRole('customer');
        $category = $this->createCategory();

        $data = [
            'name' => 'Test SubCategory',
            'category_id' => $category->id,
            'image' => null,
        ];

        $response = $this->actingAs($customer, 'sanctum')
            ->postJson('/api/v1/admin/subCategories', $data);

        $response->assertStatus(403);
    }

    public function test_customer_cannot_update_subCategory(): void
    {
        $customer = $this->createUserWithRole('customer');
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category);

        $data = [
            'name' => 'Updated Category Name',
            'category_id' => $category->id,
            'image' => null,
        ];

        $response = $this->actingAs($customer, 'sanctum')
            ->putJson("/api/v1/admin/subCategories/{$subCategory->id}", $data);

        $response->assertStatus(403);
    }

    public function test_customer_cannot_delete_subCategory(): void
    {
        $customer = $this->createUserWithRole('customer');
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category);

        $response = $this->actingAs($customer, 'sanctum')
            ->deleteJson("/api/v1/admin/subCategories/{$subCategory->id}");

        $response->assertStatus(403);
    }

    private function createUserWithRole(string $roleName): User
    {
        $role = Role::where('name', $roleName)->firstOrFail();

        return User::factory()->create([
            'email' => $this->faker->safeEmail(),
            'password' => bcrypt('password'),
            'role_id' => $role->id,
        ]);
    }

    private function createCategory(): Category
    {
        return Category::factory()->create([
            'name' => 'Test Category',
            'description' => 'This is a test category.',
            'image' => null,
        ]);
    }

    private function createSubCategory(Category $category): SubCategory
    {
        return SubCategory::factory()->create([
            'name' => 'Old Category Name',
            'category_id' => $category->id,
            'image' => null,
        ]);
    }
}
