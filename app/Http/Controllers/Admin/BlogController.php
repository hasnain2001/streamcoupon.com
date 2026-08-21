<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Language;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with(['language', 'updatedby', 'category', 'store'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.create', [
            'categories' => Category::latest()->get(),
            'languages'  => Language::latest()->get(),
            'stores'     => Store::latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'slug'             => 'required|string|max:255|unique:blogs,slug',
            'title'            => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keyword'     => 'nullable|string|max:255',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'content'          => 'nullable|string',
            'category_id'      => 'required|exists:categories,id',
            'status'           => 'nullable|boolean',
            'language_id'      => 'nullable|exists:languages,id',
            'store_id'         => 'nullable|exists:stores,id',
            'top_blog'         => 'nullable|boolean',
            'user_id'          => 'nullable|exists:users,id',
        ]);

        $blog = Blog::create([

            'name'             => $request->name,
            'slug'             => $request->slug,
            'title'            => $request->title,
            'content'          => $request->content,
            'meta_keyword'     => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'status'           => $request->status ?? 0,
            'category_id'      => $request->category_id,
            'top_blog'         => $request->top_blog ?? 0,
            'language_id'      => $request->language_id ?? 1,
            'store_id'         => $request->store_id,
            'user_id'          => Auth::id(),
        ]);

        // Handle image upload with Storage
        if ($request->hasFile('image')) {
            $this->uploadImage($request->file('image'), $blog);
        }

        return redirect()->route('admin.blog.show', $blog->id)
            ->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $blog->load(['category', 'language', 'store', 'user', 'updatedby']);
        
        return view('admin.blog.show', [
            'blog'       => $blog,
            'categories' => Category::latest()->get(),
            'languages'  => Language::latest()->get(),
            'stores'     => Store::latest()->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', [
            'blog'       => $blog,
            'categories' => Category::latest()->get(),
            'languages'  => Language::latest()->get(),
            'stores'     => Store::latest()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'slug'             => [
                'required',
                'string',
                'max:255',
                Rule::unique('blogs', 'slug')->ignore($blog->id),
            ],
            'title'            => 'required|string|max:255',
            'content'          => 'required|string',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category_id'      => 'required|exists:categories,id',
            'language_id'      => 'nullable|exists:languages,id',
            'store_id'         => 'nullable|exists:stores,id',
            'status'           => 'nullable|boolean',
            'meta_description' => 'nullable|string|max:255',
            'meta_keyword'     => 'nullable|string|max:255',
            'top_blog'         => 'nullable|boolean',
        ]);

        // Handle image update with Storage
        if ($request->hasFile('image')) {
            // Delete old image
            $this->deleteImage($blog);
            // Upload new image
            $this->uploadImage($request->file('image'), $blog);
        }

        // Update blog data
        $blog->update([
            'name'             => $request->name,
            'slug'             => $request->slug,
            'title'            => $request->title,
            'content'          => $request->content,
            'meta_keyword'     => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'status'           => $request->status ?? 0,
            'category_id'      => $request->category_id,
            'top_blog'         => $request->top_blog ?? 0,
            'language_id'      => $request->language_id ?? $blog->language_id,
            'store_id'         => $request->store_id,
             'updated_id'       => Auth::id(),
        ]);

        return redirect()->route('admin.blog.show', $blog->id)
            ->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $this->deleteImage($blog);
        $blog->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog deleted successfully.');
    }

    /**
     * Bulk delete selected resources.
     */
    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;

        if (empty($ids)) {
            return redirect()->back()->with('error', 'No blogs selected.');
        }

        $blogs = Blog::whereIn('id', $ids)->get();
        
        foreach ($blogs as $blog) {
            $this->deleteImage($blog);
            $blog->delete();
        }

        return redirect()->route('admin.blog.index')
            ->with('success', 'Selected blogs deleted successfully.');
    }

    /**
     * Upload image to storage.
     */
    private function uploadImage($image, Blog $blog)
    {
        $imageName = Str::slug($blog->slug) . '_' . time() . '.' . $image->getClientOriginalExtension();
        
        // Store in storage/app/public/blogs (matching your existing folder structure)
        $path = $image->storeAs('blogs', $imageName, 'public');
        
        // Save only the filename in database
        $blog->update(['image' => $imageName]);
        
        return $path;
    }

    /**
     * Delete image from storage.
     */
    private function deleteImage(Blog $blog)
    {
        if ($blog->image) {
            // Delete from blogs folder
            Storage::disk('public')->delete('blogs/' . $blog->image);
        }
    }
}