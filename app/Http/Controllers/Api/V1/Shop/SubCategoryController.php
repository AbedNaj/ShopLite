<?php

namespace App\Http\Controllers\Api\V1\Shop;

use App\Http\Controllers\Controller;
use App\Http\Resources\Shop\subCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SubCategory::query();
        if ($request->filled('category')) {
            $query->where('category_id', '=', $request->category);
        }
        $subCategories = $query->select('id', 'name', 'slug', 'category_id', 'image')
            ->get();

        return new subCategoryResource($subCategories);
    }


    public function show(string $id) {}
}
