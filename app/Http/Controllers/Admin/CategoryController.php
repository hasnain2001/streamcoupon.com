<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('user','updatedBy')->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'slug'            => 'required|string|max:255|unique:categories,slug',
            'top_category'    => 'nullable|integer',
            'status'          => 'required|boolean',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title'           => 'nullable|string|max:255',
            'meta_keyword'    => 'nullable|string|max:255',
            'meta_description'=> 'nullable|string|max:255',
        ]);

        // Create category record
        $category = new Category();
        $category->user_id = Auth::id();
        $category->name = $request->name;
        $category->slug = Str::slug($request->slug); // clean slug
        $category->top_category = $request->top_category;
        $category->status = $request->status;
        $category->title = $request->title;
        $category->meta_keyword = $request->meta_keyword;
        $category->meta_description = $request->meta_description;
        $category->save(); // save first to get ID

        // Handle Image Upload
        if ($request->hasFile('image')) {

            $file = $request->file('image');

            // Save image using category slug
            $imageName = $category->slug . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/categories/'), $imageName);

            // Update DB with filename
            $category->image = $imageName;
            $category->save();
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
            'name'            => 'required|string|max:255',
            'slug'            => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'top_category'    => 'nullable|integer',
            'status'          => 'required|boolean',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title'           => 'nullable|string|max:255',
            'meta_keyword'    => 'nullable|string|max:255',
            'meta_description'=> 'nullable|string|max:255',
        ]);

        $category->name = $request->name;
        $category->slug = Str::slug($request->slug);
        $category->top_category = $request->top_category;
        $category->status = $request->status;
        $category->title = $request->title;
        $category->meta_keyword = $request->meta_keyword;
        $category->meta_description = $request->meta_description;
        $category->updated_id = Auth::id();

        // Handle Image update
        if ($request->hasFile('image')) {

            // Delete old image if exists
            if ($category->image) {
                $oldPath = public_path('uploads/categories/' . $category->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('image');
            $imageName = $category->slug . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/categories/'), $imageName);

            $category->image = $imageName;
        }

        $category->save();

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->image) {
            $imgPath = public_path('uploads/categories/' . $category->image);
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }

        $category->delete();

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Category deleted successfully.');
    }
}
