<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Store;
use App\Models\Coupon;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Network;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stores = Store::with(['category', 'language'])->get();
        $coupons = Coupon::with('stores')->get();
        $langs = Language::all();
        $blogs = Blog::all();
        $categories = Category::all();
        $users = User::all();
        $networks = Network::all();

        $todayCoupons = Coupon::whereDate('created_at', today())->get();
        $todayStores  = Store::whereDate('created_at', today())->get();

        $recentCoupons = Coupon::latest()->take(5)->get();
        $recentStores  = Store::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'stores',
            'coupons',
            'langs',
            'blogs',
            'categories',
            'users',
            'networks',
            'todayCoupons',
            'todayStores',
            'recentCoupons',
            'recentStores'
        ));
    }

    /* ---------------------------------------------
       USER MANAGEMENT
    --------------------------------------------- */

    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'role'     => 'required|in:admin,user,employee',
            'password' => 'required|min:8|confirmed',
            'avatar'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = new User();
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->role  = $request->role;
        $user->password = bcrypt($request->password);

        // Handle avatar upload using Storage
        if ($request->hasFile('avatar')) {
            $avatarName = Str::slug($request->name) . '-' . time() . '.' . $request->avatar->extension();
            
            // Store in storage/app/public/avatars
            $path = $request->avatar->storeAs('avatars', $avatarName, 'public');
            
            if ($path) {
                $user->avatar = $avatarName;
            }
        }

        $user->save();

        return redirect()->route('admin.user.index')
                         ->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'nullable|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $id,
            'role'     => 'nullable|in:admin,user,employee',
            'password' => 'nullable|min:8|confirmed',
            'avatar'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);

        // Update basic fields
        $user->name  = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        $user->role  = $request->role ?? $user->role;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Handle avatar update using Storage
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if (!empty($user->avatar)) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }

            $avatarName = Str::slug($user->name) . '-' . time() . '.' . $request->avatar->extension();
            
            // Store new avatar
            $path = $request->avatar->storeAs('avatars', $avatarName, 'public');
            
            if ($path) {
                $user->avatar = $avatarName;
            }
        }

        $user->save();

        return redirect()->route('admin.user.index')
                         ->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete avatar from storage if exists
        if (!empty($user->avatar)) {
            Storage::disk('public')->delete('avatars/' . $user->avatar);
        }

        $user->delete();

        return redirect()->route('admin.user.index')
                         ->with('success', 'User deleted successfully.');
    }
}