<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithFaker;
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
    private function subCategoryMake()
    {
        return SubCategory::factory()->create([
            'category_id' => \App\Models\Category::factory(),
        ]);
    }

    public function test_admin_can_create_product(): void
    {
        Storage::fake('public'); // Fake storage

        $user = $this->adminUser();
        $subCategory = SubCategory::factory()->create([
            'category_id' => Category::factory(),
        ]);

        $data = [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'stock' => $this->faker->numberBetween(1, 100),
            'sub_category_id' => $subCategory->id,
            'category_id' => $subCategory->category_id,
            'thumbnail' => UploadedFile::fake()->image('thumbnail.jpg'),
        ];

        $response = $this->actingAs($user, 'sanctum')
            ->post('/api/v1/admin/products', $data);

        $response->assertStatus(201);
    }


    public function test_admin_can_update_product(): void
    {


        $user = $this->adminUser();

        $subCategory = $this->subCategoryMake();

        $product = Product::factory()->create(
            [
                'sub_category_id' => $subCategory->id,
            ]
        );

        $newData = [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'stock' => $this->faker->numberBetween(1, 100),
            'status' => 'active',
            'sub_category_id' => $subCategory->id,
        ];
        $response = $this->actingAs($user, 'sanctum')
            ->putJson("/api/v1/admin/products/{$product['id']}", $newData);

        $response->assertStatus(200);
    }

    public function test_admin_can_delete_product(): void
    {


        $user = $this->adminUser();

        $subCategory = $this->subCategoryMake();

        $product = Product::factory()->create(
            [
                'sub_category_id' => $subCategory->id,
            ]
        );

        $response = $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/v1/admin/products/{$product['id']}");

        $response->assertStatus(200);
    }




    public function test_customer_cannot_create_product(): void
    {


        $user = $this->customerUser();
        $subCategory = SubCategory::factory()->create([
            'category_id' => \App\Models\Category::factory(),
        ]);

        $data = [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'stock' => $this->faker->numberBetween(1, 100),
            'sub_category_id' => $subCategory->id,
        ];

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/admin/products', $data);

        $response->assertStatus(403);
    }


    public function test_customer_cannot_update_product(): void
    {


        $user = $this->customerUser();

        $subCategory = $this->subCategoryMake();

        $product = Product::factory()->create(
            [
                'sub_category_id' => $subCategory->id,
            ]
        );

        $newData = [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'stock' => $this->faker->numberBetween(1, 100),
            'status' => 'active',
            'sub_category_id' => $subCategory->id,
        ];
        $response = $this->actingAs($user, 'sanctum')
            ->putJson("/api/v1/admin/products/{$product['id']}", $newData);

        $response->assertStatus(403);
    }

    public function test_customer_cannot_delete_product(): void
    {


        $user = $this->customerUser();

        $subCategory = $this->subCategoryMake();

        $product = Product::factory()->create(
            [
                'sub_category_id' => $subCategory->id,
            ]
        );

        $response = $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/v1/admin/products/{$product['id']}");

        $response->assertStatus(403);
    }
}
