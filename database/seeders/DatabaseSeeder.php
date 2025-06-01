<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $category = Category::factory()->create([
            'name' => 'example category',

        ]);

        $subCategory = SubCategory::create([
            'name' => 'example sub category',
            'category_id' => $category->id,
        ]);
    }
}
