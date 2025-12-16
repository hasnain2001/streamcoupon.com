<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = strtolower(trim($request->input('query')));
        $slugQuery = Str::slug($query);

        $stores = Store::where('slug', 'like', "%$slugQuery%")->pluck('slug');
        $store = Store::where('slug', $slugQuery)->first();

        if ($store) {
            return redirect()->route('store.detail', ['slug' => $store->slug]);
        }

        if ($request->ajax()) {
            return response()->json(['stores' => $stores]);
        }

        return redirect()->route('search_results', ['query' => $query]);
    }
    public function searchResults(Request $request)
    {
        $query = $request->input('query');
        $searchType = $request->input('type', 'all');

        // Initialize variables
        $stores = collect();
        $coupons = collect();
        $categories = collect();
        $blogs = collect();

        // Initialize total counts
        $totalStores = 0;
        $totalCoupons = 0;
        $totalCategories = 0;
        $totalBlogs = 0;

        // Items per page configuration
        $itemsPerPage = [
            'all' => 5,
            'stores' => 12,
            'coupons' => 12,
            'categories' => 12,
            'blogs' => 6
        ];

        // Search based on type
        switch ($searchType) {
            case 'stores':
                $stores = Store::where('name', 'like', "%$query%")
                    ->paginate($itemsPerPage['stores'])
                    ->appends(['query' => $query, 'type' => $searchType]);
                $totalStores = $stores->total();
                break;

            case 'coupons':
                $coupons = Coupon::where('name', 'like', "%$query%")
                    ->with('store')
                    ->paginate($itemsPerPage['coupons'])
                    ->appends(['query' => $query, 'type' => $searchType]);
                $totalCoupons = $coupons->total();
                break;

            case 'categories':
                $categories = Category::where('name', 'like', "%$query%")
                    ->paginate($itemsPerPage['categories'])
                    ->appends(['query' => $query, 'type' => $searchType]);
                $totalCategories = $categories->total();
                break;

            case 'blogs':
                $blogs = Blog::where('name', 'like', "%$query%")
                    ->paginate($itemsPerPage['blogs'])
                    ->appends(['query' => $query, 'type' => $searchType]);
                $totalBlogs = $blogs->total();
                break;

            default: // 'all'
                // For 'all' type, calculate all totals
                $totalStores = Store::where('name', 'like', "%$query%")->count();
                $totalCoupons = Coupon::where('name', 'like', "%$query%")->orWhere('code', 'like', "%$query%")->count();
                $totalCategories = Category::where('name', 'like', "%$query%")->count();
                $totalBlogs = Blog::where('title', 'like', "%$query%")->count();

                // Get limited results
                $stores = Store::where('name', 'like', "%$query%")
                    ->limit($itemsPerPage['all'])
                    ->get();

                $coupons = Coupon::where('name', 'like', "%$query%")
                    ->with('store')
                    ->limit($itemsPerPage['all'])
                    ->get();

                $categories = Category::where('name', 'like', "%$query%")
                    ->limit($itemsPerPage['all'])
                    ->get();

                $blogs = Blog::where('name', 'like', "%$query%")
                    ->limit($itemsPerPage['all'])
                    ->get();
                break;
        }

        $store = Store::where('name', $query)->first();

        if ($store && $searchType === 'all') {
            return redirect()->route('store.detail', ['slug' => Str::slug($store->slug)]);
        }

        return view('front-end.search_result', compact(
            'stores',
            'coupons',
            'categories',
            'blogs',
            'query',
            'searchType',
            'totalStores',
            'totalCoupons',
            'totalCategories',
            'totalBlogs'
        ));
    }
}
