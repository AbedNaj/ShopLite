<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SubCategoryController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', SubCategory::class);
        try {
            $subCategories = SubCategory::with('category')->get();
            return response()->json($subCategories, 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Something went wrong. Please try again later.',

            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', SubCategory::class);
        try {


            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:sub_categories,name',
                'category_id' => 'required|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $disk = config('filesystems.default');
            $directory = env('DO_DIRECTORY', 'uploads');

            $imagePath = isset($validated['image'])
                ? Storage::disk($disk)->url(
                    $validated['image']->store("{$directory}/subCategory/{$validated['name']}", $disk)
                )
                : null;
            $subCategory = SubCategory::create([
                'name' => $validated['name'],
                'category_id' => $validated['category_id'] ?? null,
                'image' => $imagePath,
            ]);

            return response()->json($subCategory, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Something went wrong. Please try again later.',


            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = SubCategory::findOrFail($id);
        $this->authorize('view', $category);

        try {

            return response()->json($category, 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Category not found',

            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $this->authorize('update', $subCategory);
        try {


            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $subCategory->id,
                'category_id' => 'required|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $disk = config('filesystems.default');
            $directory = env('DO_DIRECTORY', 'uploads');

            if (isset($validated['image'])) {

                if ($subCategory->image) {
                    Storage::disk($disk)->delete($subCategory->image);
                }
                $imagePath = Storage::disk($disk)->url(
                    $validated['image']->store("{$directory}/category/{$validated['name']}", $disk)
                );
            } else {
                $imagePath = $subCategory->image;
            }

            $subCategory->update([
                'name' => $validated['name'],
                'category_id' => $validated['category_id'] ?? null,
                'image' => $imagePath,
            ]);

            return response()->json($subCategory, 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Something went wrong. Please try again later.',

            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $this->authorize('delete', $subCategory);

        try {
            if ($subCategory->image) {
                Storage::disk(config('filesystems.default'))->delete($subCategory->image);
            }
            $subCategory->delete();

            return response()->json(['message' => 'Category deleted successfully'], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }
}
