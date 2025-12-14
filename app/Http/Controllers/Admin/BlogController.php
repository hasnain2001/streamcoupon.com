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

        return view('admin.blog.index', compact('blogs'));
    }

    /* ============================
        CREATE
    ============================ */
    public function create()
    {
        return view('admin.blog.create', [
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
        ]);

        $blog = new Blog();
        $blog->user_id        = Auth::id();
        $blog->language_id    = $request->language_id ?? 1;
        $blog->store_id       = $request->store_id;
        $blog->name           = $request->name;
        $blog->slug           = Str::slug($request->slug);
        $blog->title          = $request->title;
        $blog->content        = $request->content;
        $blog->meta_keyword   = $request->meta_keyword;
        $blog->meta_description = $request->meta_description;
        $blog->status         = $request->status ?? 0;
        $blog->category_id    = $request->category_id;
        $blog->save();

        /* 🖼 IMAGE UPLOAD */
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::slug($blog->slug) . '.' . $image->getClientOriginalExtension();

            $uploadPath = public_path('uploads/blogs');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $image->move($uploadPath, $imageName);

            $blog->image = $imageName;
            $blog->save();
        }

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog created successfully.');
    }

    /* ============================
        EDIT
    ============================ */
    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', [
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
        $request->validate([
            'name'             => 'required|string|max:255',
            'slug'             => 'required|string|max:255|unique:blogs,slug,' . $blog->id,
            'title'            => 'required|string|max:255',
            'content'          => 'required|string',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category_id'      => 'required|exists:categories,id',
            'language_id'      => 'nullable|exists:languages,id',
            'store_id'         => 'nullable|exists:stores,id',
            'status'           => 'nullable|boolean',
        ]);

        /* 🖼 IMAGE UPDATE */
        if ($request->hasFile('image')) {

            // Delete old image
            if ($blog->image) {
                $oldPath = public_path('uploads/blogs/' . $blog->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $image = $request->file('image');
            $imageName = Str::slug($request->slug) . '.' . $image->getClientOriginalExtension();

            $uploadPath = public_path('uploads/blogs');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $image->move($uploadPath, $imageName);
            $blog->image = $imageName;
        }

        /* 📝 UPDATE DATA */
        $blog->updated_id       = Auth::id();
        $blog->language_id      = $request->language_id ?? $blog->language_id;
        $blog->store_id         = $request->store_id;
        $blog->name             = $request->name;
        $blog->slug             = Str::slug($request->slug);
        $blog->title            = $request->title;
        $blog->content          = $request->content;
        $blog->meta_keyword     = $request->meta_keyword;
        $blog->meta_description = $request->meta_description;
        $blog->status           = $request->status ?? 0;
        $blog->category_id      = $request->category_id;
        $blog->save();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog updated successfully.');
    }

    /* ============================
        DELETE SINGLE
    ============================ */
    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            $imagePath = public_path('uploads/blogs/' . $blog->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $blog->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog deleted successfully.');
    }

    /* ============================
        BULK DELETE
    ============================ */
    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;

        if (!$ids) {
            return redirect()->back()->with('error', 'No blogs selected.');
        }

        foreach ($ids as $id) {
            $blog = Blog::find($id);
            if ($blog) {
                if ($blog->image) {
                    $path = public_path('uploads/blogs/' . $blog->image);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                $blog->delete();
            }
        }

        return redirect()->route('admin.blog.index')
            ->with('success', 'Selected blogs deleted successfully.');
    }
}
