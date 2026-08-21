<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('user', 'updatedBy')->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'slug'             => 'required|string|max:255|unique:categories,slug',
            'top_category'     => 'nullable|integer',
            'status'           => 'required|boolean',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title'            => 'nullable|string|max:255',
            'meta_keyword'     => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'authentication'    => 'nullable|string|max:255',
        ]);

        // Create category record
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->top_category = $request->top_category;
        $category->status = $request->status;
        $category->title = $request->title;
        $category->meta_keyword = $request->meta_keyword;
        $category->meta_description = $request->meta_description;
        $category->authentication = $request->authentication;
        $category->user_id = Auth::id();
        $category->save();

        // Handle Image Upload using Storage
        if ($request->hasFile('image')) {
            $this->uploadImage($request->file('image'), $category);
        }

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'slug'             => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'top_category'     => 'nullable|integer',
            'status'           => 'required|boolean',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title'            => 'nullable|string|max:255',
            'meta_keyword'     => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->top_category = $request->top_category;
        $category->status = $request->status;
        $category->title = $request->title;
        $category->meta_keyword = $request->meta_keyword;
        $category->meta_description = $request->meta_description;
        $category->authentication = $request->authentication;
        $category->updated_id = Auth::id();

        // Handle Image update using Storage
        if ($request->hasFile('image')) {
            // Delete old image if exists
            $this->deleteImage($category);
            // Upload new image
            $this->uploadImage($request->file('image'), $category);
        }

        $category->save();

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Delete image from storage if exists
        if (!empty($category->image)) {
            Storage::disk('public')->delete('categories/' . $category->image);
        }

        $category->delete();

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Category deleted successfully.');
    }
    private function uploadImage($image, Category $category)
    {

        $imageName = Str::slug($category->slug) . '.' . $image->getClientOriginalExtension();
        
        // Store in storage/app/public/categories (matching your existing folder structure)
        $path = $image->storeAs('categories', $imageName, 'public');
        
        // Save only the filename in database
        $category->update(['image' => $imageName]);
        
        return $path;
    }

    /**
     * Delete image from storage.
     */
    private function deleteImage(Category $category)
    {
        if ($category->image) {
            // Delete from categories folder
            Storage::disk('public')->delete('categories/' . $category->image);
        }
    }
}