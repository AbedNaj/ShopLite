<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Enums\ProductStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ProductResource;
use App\Http\Resources\ProductResource as createProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Product::class);
        $products = Product::with('subCategory:id,name')->orderBy('created_at', 'desc')->paginate(10);
        return new ProductResource($products);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        $enumStatus = ProductStatusEnum::cases();
        $status = implode(',', array_map(fn($status) => $status->value(), $enumStatus));

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'nullable|in:' . $status,
            'stock' => 'nullable|integer|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'thumbnail' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        if (
            isset($validated['discount_price']) &&

            $validated['price'] < $validated['discount_price']
        ) {
            throw ValidationException::withMessages([
                'discount_price' => ['Discount price must be less than the actual price.'],
            ]);
        }

        $disk = config('filesystems.default');
        $directory = env('DO_DIRECTORY', 'uploads');

        $thumbnail =  isset($validated['thumbnail']) ? Storage::disk($disk)->url($validated['thumbnail']->store("{$directory}/product/{$validated['name']}", $disk)) : null;



        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'sub_category_id' => $validated['sub_category_id'],
            'status' => $validated['status'] ?? ProductStatusEnum::Active->value(),
            'price' => $validated['price'],
            'stock' => $validated['stock'] ?? 0,
            'discount_price' => $validated['discount_price'] ?? null,
            'thumbnail' => $thumbnail
        ]);

        if ($request->hasFile('images')) {


            foreach ($request->file('images') as $index => $image) {
                $path = Storage::disk($disk)->url(
                    $image->store("{$directory}/product/{$product['slug']}", $disk)
                );

                $product->images()->create([
                    'image_path' => $path,
                    'order' => $index,
                ]);
            }
        }

        return new createProduct($product);
    }

    public function show(string $id)
    {
        $product = Product::with('subCategory:id,name')->with('images:id,product_id,image_path,order')->findOrFail($id);
        $this->authorize('view', $product);

        return new ProductResource($product);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);

        $enumStatus = ProductStatusEnum::cases();
        $status = implode(',', array_map(fn($status) => $status->value(), $enumStatus));

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'sub_category_id' => 'required|exists:sub_categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'thumbnail' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        if (
            isset($validated['discount_price']) &&

            $validated['price'] < $validated['discount_price']
        ) {
            throw ValidationException::withMessages([
                'discount_price' => ['Discount price must be less than the actual price.'],
            ]);
        }
        $disk = config('filesystems.default');
        $directory = env('DO_DIRECTORY', 'uploads');


        if (isset($validated['thumbnail'])) {
            if ($product->image) {
                Storage::disk($disk)->delete($product->image);
            }

            $imagePath = Storage::disk($disk)->url($validated['thumbnail']->store("{$directory}/product/{$validated['name']}", $disk));
        } else {
            $imagePath = $product->thumbnail;
        }
        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'sub_category_id' => $validated['sub_category_id'],
            'price' => $validated['price'] ?? 0,
            'stock' => $validated['stock'] ?? 0,
            'discount_price' => $validated['discount_price'] ?? 0,
            'thumbnail' => $imagePath
        ]);

        if ($request->hasFile('images')) {


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
        $product->load('images:id,product_id,image_path,order');
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
