<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Language;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /* ============================
        INDEX
    ============================ */
    public function index()
    {
        $blogs = Blog::with('language', 'updatedby')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('employee.blog.index', compact('blogs'));
    }

    /* ============================
        CREATE
    ============================ */
    public function create()
    {
        return view('employee.blog.create', [
            'categories' => Category::latest()->get(),
            'languages'  => Language::latest()->get(),
            'stores'     => Store::latest()->get(),
        ]);
    }

    /* ============================
        STORE
    ============================ */
    public function store(Request $request)
    {
        $request->validate([
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
            'user_id'          => 'nullable|exists:users,id',
            'top_blog'              => 'nullable|boolean',
        ]);

        $blog = new Blog();
        $blog->user_id        = Auth::id();
        $blog->language_id    = $request->language_id ?? 1;
        $blog->store_id       = $request->store_id;
        $blog->name           = $request->name;
        $blog->slug           = $request->slug;
        $blog->title          = $request->title;
        $blog->content        = $request->content;
        $blog->meta_keyword   = $request->meta_keyword;
        $blog->meta_description = $request->meta_description;
        $blog->status         = $request->status ?? 0;
        $blog->category_id    = $request->category_id;
        $blog->top_blog       = $request->top_blog ?? 0;
        $blog->save();

        /* 🖼 IMAGE UPLOAD */
        if ($request->hasFile('image')) {
            $this->uploadImage($request->file('image'), $blog);
        }

        return redirect()->route('employee.blog.show', $blog->id)
            ->with('success', 'Blog created successfully.');
    }

    /* ============================
        SHOW
    ============================ */
        public function show(Blog $blog)
    {
        $blog->load(['category', 'language', 'store', 'user', 'updatedby']);
        
        return view('employee.blog.show', [
            'blog'       => $blog,
            'categories' => Category::latest()->get(),
            'languages'  => Language::latest()->get(),
            'stores'     => Store::latest()->get(),
        ]);
    }
     /* ============================
        EDIT
    ============================ */
    public function edit(Blog $blog)
    {
        return view('employee.blog.edit', [
            'blog'       => $blog,
            'categories' => Category::latest()->get(),
            'languages'  => Language::latest()->get(),
            'stores'     => Store::latest()->get(),
        ]);
    }

    /* ============================
        UPDATE
    ============================ */
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

        /* 🖼 IMAGE UPDATE */
        if ($request->hasFile('image')) {
            // Delete old image
            $this->deleteImage($blog);
            // Upload new image
            $this->uploadImage($request->file('image'), $blog);
        }

        /* 📝 UPDATE DATA */
        $blog->updated_id       = Auth::id();
        $blog->language_id      = $request->language_id ?? $blog->language_id;
        $blog->store_id         = $request->store_id;
        $blog->name             = $request->name;
        $blog->slug             = $request->slug;
        $blog->title            = $request->title;
        $blog->content          = $request->content;
        $blog->meta_keyword     = $request->meta_keyword;
        $blog->meta_description = $request->meta_description;
        $blog->status           = $request->status ?? 0;
        $blog->category_id      = $request->category_id;
        $blog->top_blog         = $request->top_blog ?? 0;
        $blog->save();

        return redirect()->route('employee.blog.show', $blog->id)
            ->with('success', 'Blog updated successfully.');
    }

    /* ============================
        DELETE
    ============================ */
    public function destroy(Blog $blog)
    {
        $this->deleteImage($blog);
        $blog->delete();

        return redirect()->route('employee.blog.index')
            ->with('success', 'Blog deleted successfully.');
    }
    /* ============================
            DELETE SELECTED
        ============================ */
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

        return redirect()->route('employee.blog.index')
            ->with('success', 'Selected blogs deleted successfully.');
    }
    /* ============================
        UPLOAD IMAGE
    ============================ */
     private function uploadImage($image, Blog $blog)
    {
        $imageName = Str::slug($blog->slug) . '_' . time() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('blogs', $imageName, 'public');
        $blog->update(['image' => $imageName]);
        return $path;
    }
    /* ============================
        DELETE IMAGE
    ============================ */
    private function deleteImage(Blog $blog)
    {
        if ($blog->image) {
            Storage::disk('public')->delete('blogs/' . $blog->image);
        }
    }
}
