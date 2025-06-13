<?php

namespace App\Http\Controllers\Api\V1\Shop;

use App\Enums\ProductStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Shop\HomeResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function categories(Request $request)
    {
        $limit = $request->input('limit', 6);
        $offset = $request->input('offset', 0);

        $categories = Category::select('id', 'name', 'image')
            ->where('is_active', true)
            ->skip($offset)
            ->take($limit)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'data' => $categories,
            'meta' => [
                'total' => Category::where('is_active', true)->count(),
                'offset' => (int) $offset,
                'limit' => (int) $limit,
            ]
        ]);
    }

    public function recentProducts(Request $request)
    {

        $recentProducts = Product::select('id', 'name', 'price', 'discount_price', 'price_after_discount', 'thumbnail')->orderByDesc('created_at')
            ->where('status', '=', ProductStatusEnum::Active->value())->limit(10)->get();

        return new HomeResource($recentProducts);
    }

    public function discountProducts()
    {

        $recentProducts = Product::select('id', 'name', 'price', 'discount_price', 'price_after_discount', 'thumbnail')
            ->orderByDesc('created_at')->where('discount_price', '>', 0)->where('status', '=', ProductStatusEnum::Active->value())->limit(9)->get();

        return new HomeResource($recentProducts);
    }
}
