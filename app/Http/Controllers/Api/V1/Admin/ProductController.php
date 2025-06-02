<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Enums\ProductStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Product::class);
        $products = Product::with('subCategory')->get();
        return ProductResource::collection($products);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        $enumStatus = ProductStatusEnum::cases();
        $status = implode(',', array_map(fn($status) => $status->value(), $enumStatus));

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'nullable|in:' . $status,
            'stock' => 'nullable|integer|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product = Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? null,
            'sub_category_id' => $validatedData['sub_category_id'],
            'status' => $validatedData['status'] ?? ProductStatusEnum::Active->value(),
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'] ?? 0,
            'discount_price' => $validatedData['discount_price'] ?? null,
        ]);

        if ($request->hasFile('images')) {
            $disk = config('filesystems.default');
            $directory = env('DO_DIRECTORY', 'uploads');

            foreach ($request->file('images') as $index => $image) {
                $path = Storage::disk($disk)->url(
                    $image->store("{$directory}/product/{$product['slug']}", $disk)
                );

                $product->images()->create([
                    'image_path' => $path,
                    'is_primary' => $index === 0,
                    'order' => $index,
                ]);
            }
        }

        return new ProductResource($product);
    }

    public function show(string $id)
    {
        $product = Product::with('subCategory')->findOrFail($id);
        $this->authorize('view', $product);

        return new ProductResource($product);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);

        $enumStatus = ProductStatusEnum::cases();
        $status = implode(',', array_map(fn($status) => $status->value(), $enumStatus));

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'sub_category_id' => 'required|exists:sub_categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'status' => 'required|in:' . $status,
            'discount_price' => 'nullable|numeric|min:0',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? null,
            'sub_category_id' => $validatedData['sub_category_id'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'] ?? 0,
            'status' => $validatedData['status'],
            'discount_price' => $validatedData['discount_price'] ?? null,
        ]);

        if ($request->hasFile('images')) {
            $disk = config('filesystems.default');
            $directory = env('DO_DIRECTORY', 'uploads');

            foreach ($request->file('images') as $index => $image) {
                $path = Storage::disk($disk)->url(
                    $image->store("{$directory}/product/{$product['slug']}", $disk)
                );

                $product->images()->create([
                    'image_path' => $path,
                    'is_primary' => $index === 0,
                    'order' => $index,
                ]);
            }
        }

        return new ProductResource($product);
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);

        if ($product->image) {
            Storage::disk(config('filesystems.default'))->delete($product->image);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
