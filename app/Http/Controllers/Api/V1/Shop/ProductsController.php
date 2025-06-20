<?php

namespace App\Http\Controllers\Api\V1\Shop;

use App\Http\Controllers\Controller;
use App\Http\Resources\Shop\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();


        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('subcategory')) {
            $query->where('sub_category_id', $request->subcategory);
        }

        if ($request->filled('min_price')) {
            $query->where('price_after_discount', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price_after_discount', '<=', $request->max_price);
        }


        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }


        switch ($request->sort) {
            case 'lowToHigh':
                $query->orderByRaw('price_after_discount');
                break;
            case 'highToLow':
                $query->orderByDesc('price_after_discount');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;

            case 'discounted':
                $query->where('discount_price', '>', 0);
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate($request->input('item', 12));

        return new ProductResource($products);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
