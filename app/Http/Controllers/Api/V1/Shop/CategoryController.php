<?php

namespace App\Http\Controllers\Api\V1\Shop;

use App\Http\Controllers\Controller;
use App\Http\Resources\Shop\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::select('id', 'name', 'slug', 'image')->where('is_active', '=', true)->get();

        return new CategoryResource($categories);
    }

    public function show(string $id)
    {
        $categories = Category::select('id', 'name', 'slug', 'image')->with('subCategory:id,name,category_id')
            ->where('is_active', '=', true)->where('id', '=', $id)->get();

        return new CategoryResource($categories);
    }
}
