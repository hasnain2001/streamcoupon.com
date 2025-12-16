<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Store;
use App\Models\Coupon;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Network;
class EmployeeController extends Controller
{
   public function dashboard()
    {
        $stores = Store::with(['category', 'language'])->get();
        $coupons = Coupon::with('stores')->get();
        $langs = Language::all();
        $blogs = Blog::all();
        $categories = Category::all();
        $networks = Network::all();

        // Get today's data with proper date filtering
        $todayCoupons = Coupon::whereDate('created_at', today())->get();
        $todayStores = Store::whereDate('created_at', today())->get();
        $recentCoupons = Coupon::orderBy('created_at', 'desc')->take(5)->get();
        $recentStores = Store::orderBy('created_at', 'desc')->take(5)->get();
        return view('employee.dashboard', compact(
            'stores',
            'coupons',
            'langs',
            'blogs',
            'categories',
            'networks',
            'todayCoupons',
            'todayStores',
            'recentCoupons',
            'recentStores'
        ));
    }

}
