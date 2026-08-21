<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Coupon;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Network;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    /**
     * Main search method with AJAX support
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Validate query
        if (empty($query) || strlen($query) < 2) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Please enter at least 2 characters'
                ], 422);
            }
            return redirect()->back()->with('error', 'Please enter at least 2 characters');
        }

        // Search in all models
        $stores = Store::where('name', 'LIKE', "%{$query}%")
            ->orWhere('slug', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->with(['category', 'network', 'language'])
            ->limit(10)
            ->get();

        $coupons = Coupon::where('code', 'LIKE', "%{$query}%")
            ->orWhere('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->with('store')
            ->limit(10)
            ->get();

        $blogs = Blog::where('name', 'LIKE', "%{$query}%")
            ->orWhere('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->orWhere('title', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        $networks = Network::where('name', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        // Check for exact store match
        $exactStore = Store::where('slug', $query)->orWhere('slug', $query)->first();

        if ($exactStore && $request->ajax()) {
            return response()->json([
                'status' => 'redirect',
                'url' => route('admin.store.show', $exactStore->id)
            ]);
        }

        // Return AJAX response with rendered partials
        if ($request->ajax()) {
            $html = '';
            
            // Render each partial if there are results
            if ($stores->count() > 0) {
                $html .= view('admin.search.partials.stores', ['stores' => $stores])->render();
            }
            
            if ($coupons->count() > 0) {
                $html .= view('admin.search.partials.coupons', ['coupons' => $coupons])->render();
            }
            
            if ($blogs->count() > 0) {
                $html .= view('admin.search.partials.blogs', ['blogs' => $blogs])->render();
            }
            
            if ($categories->count() > 0) {
                $html .= view('admin.search.partials.categories', ['categories' => $categories])->render();
            }
            
            if ($networks->count() > 0) {
                $html .= view('admin.search.partials.networks', ['networks' => $networks])->render();
            }

            return response()->json([
                'status' => 'success',
                'html' => $html,
                'total_results' => $stores->count() + $coupons->count() + 
                                  $blogs->count() + $categories->count() + 
                                  $networks->count()
            ]);
        }

        // If not AJAX, redirect to results page
        return redirect()->route('admin.search.index', ['query' => $query]);
    }

    /**
     * Display search results page with pagination
     */
    public function searchResults(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            return redirect()->route('admin.store.index')->with('error', 'Please enter a search term');
        }

        // Paginated results for main view
        $stores = Store::where('name', 'LIKE', "%{$query}%")
            ->orWhere('slug', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->with(['category', 'network', 'language'])
            ->paginate(20);

        $coupons = Coupon::where('code', 'LIKE', "%{$query}%")
            ->orWhere('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->with('store')
            ->paginate(10);

        $blogs = Blog::where('name', 'LIKE', "%{$query}%")
            ->orWhere('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->paginate(10);

        $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->paginate(10);

        $networks = Network::where('name', 'LIKE', "%{$query}%")
            ->paginate(10);

        $stores->appends(['query' => $query]);
        $coupons->appends(['query' => $query]);
        $blogs->appends(['query' => $query]);
        $categories->appends(['query' => $query]);
        $networks->appends(['query' => $query]);

        // Check for exact match
        $exactStore = Store::where('slug', $query)->first();
        if ($exactStore) {
            return redirect()->route('admin.store.show', $exactStore->id);
        }

        return view('admin.search.index', [
            'query' => $query,
            'stores' => $stores,
            'coupons' => $coupons,
            'blogs' => $blogs,
            'categories' => $categories,
            'networks' => $networks,
            'total_results' => $stores->total() + $coupons->total() + 
                             $blogs->total() + $categories->total() + 
                             $networks->total()
        ]);
    }

    /**
     * Search stores only (AJAX)
     */
    public function searchStores(Request $request)
    {
        $query = $request->input('query');
        
        if (empty($query) || strlen($query) < 2) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please enter at least 2 characters'
            ], 422);
        }

        $stores = Store::where('name', 'LIKE', "%{$query}%")
            ->orWhere('slug', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->with(['category', 'network', 'language'])
            ->limit(10)
            ->get();

        $html = view('admin.search.partials.stores', ['stores' => $stores])->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
            'count' => $stores->count()
        ]);
    }

    /**
     * Search coupons only (AJAX)
     */
    public function searchCoupons(Request $request)
    {
        $query = $request->input('query');
        
        if (empty($query) || strlen($query) < 2) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please enter at least 2 characters'
            ], 422);
        }

        $coupons = Coupon::where('code', 'LIKE', "%{$query}%")
            ->orWhere('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->with('store')
            ->limit(10)
            ->get();

        $html = view('admin.search.partials.coupons', ['coupons' => $coupons])->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
            'count' => $coupons->count()
        ]);
    }

    /**
     * Auto-complete search
     */
    public function autocomplete(Request $request)
    {
        $query = $request->input('query');
        
        if (empty($query) || strlen($query) < 2) {
            return response()->json([]);
        }

        $results = [];

        // Search stores
        $stores = Store::where('name', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get(['id', 'name', 'slug', 'image']);

        foreach ($stores as $store) {
            $results[] = [
                'type' => 'store',
                'id' => $store->id,
                'name' => $store->name,
                'slug' => $store->slug,
                'image' => $store->image,
                'url' => route('admin.store.show', $store->id),
                'label' => $store->name . ' (Store)'
            ];
        }

        // Search coupons
        $coupons = Coupon::where('code', 'LIKE', "%{$query}%")
            ->orWhere('title', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get(['id', 'code', 'title', 'store_id']);

        foreach ($coupons as $coupon) {
            $results[] = [
                'type' => 'coupon',
                'id' => $coupon->id,
                'name' => $coupon->code,
                'title' => $coupon->title,
                'store_id' => $coupon->store_id,
                'label' => $coupon->code . ' (Coupon)'
            ];
        }

        // Search blogs
        $blogs = Blog::where('title', 'LIKE', "%{$query}%")
            ->limit(3)
            ->get(['id', 'title', 'slug']);

        foreach ($blogs as $blog) {
            $results[] = [
                'type' => 'blog',
                'id' => $blog->id,
                'name' => $blog->title,
                'slug' => $blog->slug,
                'label' => $blog->title . ' (Blog)'
            ];
        }

        return response()->json($results);
    }
}