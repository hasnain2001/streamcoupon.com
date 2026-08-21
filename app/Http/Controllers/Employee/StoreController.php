<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Language;
use App\Models\Category;
use App\Models\Network;
use App\Models\Coupon;

class StoreController extends Controller
{
    /* ============================
       Index
    ============================ */
    public function index(Request $request)
    {
        // Get all languages that have stores
        $languages = Language::whereHas('stores')->get();

        $selectedLanguage = $request->input('language_id');

        // Build the stores query
        $query = Store::select('id', 'slug', 'name', 'category_id', 'user_id', 'network_id', 'image', 'created_at', 'status', 'updated_id', 'updated_at', 'language_id')
            ->with('user', 'updatedby', 'language', 'network')
            ->when($selectedLanguage, function($query) use ($selectedLanguage) {
                return $query->where('language_id', $selectedLanguage);
            })
            ->orderBy('created_at', 'desc');

        // If AJAX request, return only partial view
        if ($request->ajax()) {
            $stores = $query->limit(200)->get();

            return response()->json([
                'html' => view('employee.stores.partials.store-list', compact('stores'))->render()
            ]);
        }

        // Otherwise, return full view
        $stores = $query->get();

        return view('employee.stores.index', compact('stores', 'languages', 'selectedLanguage'));
    }

    /* ============================
        Create
    ============================ */
       public function create()
    {
      $categories = Category::orderBy('created_at', 'desc')->get();
        $networks = Network::orderBy('created_at', 'desc')->get();
        $languages = language::orderBy('created_at', 'desc')->get();
        return view('employee.stores.create', compact('categories', 'networks', 'languages'));
    }

    /* ============================
       Store
    ============================ */
        public function store(Request $request)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:stores,slug',
                'status' => 'required|boolean',
                'url' => 'required|url',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'title' => 'nullable|string|max:255',
                'meta_keyword' => 'nullable',
                'meta_description' => 'nullable|string|max:255',
                'content' => 'nullable|string',
                'about' => 'nullable|string',
                'description' => 'nullable|string',
                'language_id' => 'required|exists:languages,id',
                'category_id' => 'required|exists:categories,id',
                'network_id' => 'nullable|exists:networks,id',
                'top_store' => 'nullable|boolean',
                'destination_url' => 'nullable|url',
            ]);

            /* ---------------------------
            1️⃣ Create Store
            ----------------------------*/
            $store = new Store();
            $store->user_id = Auth::id();
            $store->language_id = $validated['language_id'];
            $store->category_id = $validated['category_id'];
            $store->network_id = $validated['network_id'] ?? null;
            $store->top_store = $validated['top_store'] ?? 0;
            $store->destination_url = $validated['destination_url'] ?? null;
            $store->name = $validated['name'];
            $store->slug = $validated['slug'];
            $store->status = $validated['status'];
            $store->title = $validated['title'] ?? null;
            $store->meta_keyword = $validated['meta_keyword'] ?? null;
            $store->meta_description = $validated['meta_description'] ?? null;
            $store->content = $validated['content'] ?? null;
            $store->about = $validated['about'] ?? null;
            $store->description = $validated['description'];
            $store->url = $validated['url'];
            $store->save();

            /* ---------------------------
            2️⃣ Handle Image Upload
            ----------------------------*/
        if ($request->hasFile('image')) {
            $this->uploadImage($request->file('image'), $store);
        }
            return redirect()->route('employee.store.show', $store->id)->with('success', 'Store created successfully.');
        }

    /* ============================
        Show
    ============================ */
    public function show(Store $store)
    {

        if (!$store) {
            abort(404);
        }

        // Get related coupons
        $coupons = Coupon::with('user')
            ->where('store_id', $store->id)
            ->orderByRaw('CAST(`order` AS SIGNED) ASC')
            ->get();
        $stores = Store::with('user', 'language', 'category', 'network')->orderBy('created_at', 'desc')->get();
        $languages = language::orderBy('created_at', 'desc')->get();

        return view('employee.stores.show', compact('store', 'coupons', 'stores', 'languages'));
    }

     /* ============================
      EDit
    ============================ */
    public function edit(Store $store)
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        $networks = Network::orderBy('created_at', 'desc')->get();
        $languages = Language::orderBy('created_at', 'desc')->get();
        return view('employee.stores.edit', compact('store', 'categories', 'networks', 'languages'));
    }

    /* ============================
      Update
    ============================ */

    public function update(Request $request, Store $store)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:stores,slug,' . $store->id,
            'status' => 'required|boolean',
            'url' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable',
            'meta_description' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'about' => 'nullable|string',
            'description' => 'nullable|string',
            'language_id' => 'required|exists:languages,id',
            'category_id' => 'required|exists:categories,id',
            'network_id' => 'nullable|exists:networks,id',
            'top_store' => 'nullable|boolean',
            'destination_url' => 'nullable|url',
        ]);

        /* ---------------------------
        1️⃣ Update Store Data
        ----------------------------*/
        $store->update([
            'updated_id'       => Auth::id(),
            'language_id'      => $validated['language_id'],
            'category_id'      => $validated['category_id'],
            'network_id'       => $validated['network_id'] ?? null,
            'top_store'        => $validated['top_store'] ?? 0,
            'destination_url'  => $validated['destination_url'] ?? null,
            'name'             => $validated['name'],
            'slug'             => $validated['slug'],
            'status'           => $validated['status'],
            'title'            => $validated['title'] ?? null,
            'meta_keyword'     => $validated['meta_keyword'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'content'          => $validated['content'] ?? null,
            'about'            => $validated['about'] ?? null,
            'description'      => $validated['description'],
            'url'              => $validated['url'],
        ]);

        /* ---------------------------
        2️⃣ Handle Image Upload
        ----------------------------*/
        if ($request->hasFile('image')) {
            // Delete old image if exists
            $this->deleteImage($store);

            // Upload new image
            $this->uploadImage($request->file('image'), $store);
        }

        return redirect()
            ->route('employee.store.show', $store->id)
            ->with('success', 'Store updated successfully.');
    }

    /* ============================
        DELETE 
    ============================ */
    public function destroy(Store $store)
    {
        if ($store->image) {
            $imgPath = public_path('uploads/stores/' . $store->image);
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }
        $store->delete();

        return redirect()
            ->route('employee.store.index')
            ->with('success', 'Store deleted successfully.');
    }
     /* ============================
       Upload IMAGE
    ============================ */

        private function uploadImage($image, Store $store)
    {
        
        $imageName = Str::slug($store->slug) . '_' . time() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('stores', $imageName, 'public');
        
        // Save only the filename in database
        $store->update(['image' => $imageName]);
        
        
        return $path;
    }
     /* ============================
        DELETE IMAGE
    ============================ */
        private function deleteImage(Store $store)
    {
        if ($store->image) {
            // Delete from stores folder
            Storage::disk('public')->delete('stores/' . $store->image);
        }
    }
}
