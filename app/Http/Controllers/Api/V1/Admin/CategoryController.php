<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;



class CategoryController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('viewAny', Category::class);
        try {
            $categories = Category::all();
            return response()->json($categories, 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Something went wrong. Please try again later.',

            ], 500);
        }
    }

    public function store(Request $request)
    {
        $this->authorize('create', Category::class);
        try {


            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $disk = config('filesystems.default');
            $directory = env('DO_DIRECTORY', 'uploads');

            $imagePath = isset($validated['image'])
                ? Storage::disk($disk)->url(
                    $validated['image']->store("{$directory}/service/{$validated['name']}", $disk)
                )
                : null;
            $category = Category::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'image' => $imagePath,
            ]);

            return response()->json($category, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Something went wrong. Please try again later.',

                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(string $id)
    {
        $category = Category::findOrFail($id);
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
        $category = Category::findOrFail($id);
        $this->authorize('update', $category);
        try {


            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $disk = config('filesystems.default');
            $directory = env('DO_DIRECTORY', 'uploads');

            if (isset($validated['image'])) {

                if ($category->image) {
                    Storage::disk($disk)->delete($category->image);
                }
                $imagePath = Storage::disk($disk)->url(
                    $validated['image']->store("{$directory}/service/{$validated['name']}", $disk)
                );
            } else {
                $imagePath = $category->image;
            }

            $category->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'image' => $imagePath,
            ]);

            return response()->json($category, 200);
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


    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $this->authorize('delete', $category);

        try {
            if ($category->image) {
                Storage::disk(config('filesystems.default'))->delete($category->image);
            }
            $category->delete();

            return response()->json(['message' => 'Category deleted successfully'], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }
}
