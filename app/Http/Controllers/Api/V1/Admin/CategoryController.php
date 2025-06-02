<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CategoryResource;
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

        $categories = Category::all();
        return new CategoryResource($categories);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Category::class);



        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $disk = config('filesystems.default');
        $directory = env('DO_DIRECTORY', 'uploads');

        $imagePath = isset($validated['image'])
            ? Storage::disk($disk)->url(
                $validated['image']->store("{$directory}/category/{$validated['name']}", $disk)
            )
            : null;
        $category = Category::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'image' => $imagePath,
        ]);

        return new CategoryResource($category);
    }

    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        $this->authorize('view', $category);

        return new CategoryResource($category);
    }


    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $this->authorize('update', $category);



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
                $validated['image']->store("{$directory}/category/{$validated['name']}", $disk)
            );
        } else {
            $imagePath = $category->image;
        }

        $category->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image' => $imagePath,
        ]);

        return new CategoryResource($category,);
    }


    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $this->authorize('delete', $category);


        if ($category->image) {
            Storage::disk(config('filesystems.default'))->delete($category->image);
        }
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
