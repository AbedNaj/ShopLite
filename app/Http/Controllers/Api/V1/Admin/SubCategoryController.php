<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\SubCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', SubCategory::class);

        $subCategories = SubCategory::with('category:id,name')->orderByDesc('created_at')->paginate(10);
        return new SubCategoryResource($subCategories);
    }

    public function store(Request $request)
    {
        $this->authorize('create', SubCategory::class);

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
            'category_id' => $validated['category_id'],
            'image' => $imagePath,
        ]);

        return new SubCategoryResource($subCategory);
    }

    public function show(string $id)
    {
        $subCategory = SubCategory::with('category:id,name')->findOrFail($id);
        $this->authorize('view', $subCategory);

        return new SubCategoryResource($subCategory);
    }

    public function update(Request $request, string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $this->authorize('update', $subCategory);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:sub_categories,name,' . $subCategory->id,
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
                $validated['image']->store("{$directory}/subCategory/{$validated['name']}", $disk)
            );
        } else {
            $imagePath = $subCategory->image;
        }

        $subCategory->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'image' => $imagePath,
        ]);

        return new SubCategoryResource($subCategory);
    }

    public function destroy(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $this->authorize('delete', $subCategory);

        if ($subCategory->image) {
            Storage::disk(config('filesystems.default'))->delete($subCategory->image);
        }

        $subCategory->delete();

        return response()->json(['message' => 'Subcategory deleted successfully'], 200);
    }

    public function forSelect()
    {
        $this->authorize('viewAny', SubCategory::class);
        $subCategories =  SubCategory::select('id', 'name')->orderBy('name')->get();

        return new SubCategoryResource($subCategories);
    }
}
