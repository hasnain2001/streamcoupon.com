<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('admin.language.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.language.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'code'  => 'required|string|max:10|unique:languages,code',
            'flag'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $language = new Language();
        $language->name = $request->name;
        $language->code = $request->code;
        $language->user_id = Auth::id();
        $language->status = $request->status;

        /** 🖼 Save flag **/
        if ($request->hasFile('flag')) {
            $flagName = Str::slug($request->name) . '.' . $request->flag->extension();
            $request->flag->move(public_path('uploads/flags'), $flagName);
            $language->flag = $flagName;
        }

        $language->save();

        return redirect()->route('admin.language.index')->with('success', 'Language created successfully.');
    }

    public function edit(Language $language)
    {
        return view('admin.language.edit', compact('language'));
    }

    public function update(Request $request, Language $language)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'code'  => 'required|string|max:10|unique:languages,code,' . $language->id,
            'flag'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $language->name = $request->name;
        $language->code = $request->code;
        $language->updated_id = Auth::id();
        $language->status = $request->status;

        /** 🖼 Handle updated flag **/
        if ($request->hasFile('flag')) {

            // Delete old flag if exists
            if ($language->flag && file_exists(public_path('uploads/flags/' . $language->flag))) {
                unlink(public_path('uploads/flags/' . $language->flag));
            }

            // Save new flag
            $flagName = Str::slug($request->name) . '.' . $request->flag->extension();
            $request->flag->move(public_path('uploads/flags'), $flagName);
            $language->flag = $flagName;
        }

        $language->save();

        return redirect()->route('admin.language.index')->with('success', 'Language updated successfully.');
    }

    public function destroy(Language $language)
    {
        // Delete flag
        if ($language->flag) {
            $flagPath = public_path('uploads/flags/' . $language->flag);
            if (file_exists($flagPath)) {
                unlink($flagPath);
            }
        }

        $language->delete();

        return redirect()->route('admin.language.index')->with('success', 'Language deleted successfully.');
    }
}
