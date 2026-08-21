<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'name'   => 'required|string|max:255',
            'code'   => 'required|string|max:10|unique:languages,code',
            'flag'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $language = new Language();
        $language->name = $request->name;
        $language->code = $request->code;
        $language->user_id = Auth::id();
        $language->status = $request->status;

        // Upload flag if provided
        if ($request->hasFile('flag')) {
            $filename = $this->uploadFlag($request->file('flag'), $request->name);
            if ($filename) {
                $language->flag = $filename;
            } else {
                // Optionally handle upload failure
                return back()->withInput()->with('error', 'Failed to upload flag image.');
            }
        }

        $language->save();

        return redirect()->route('admin.language.index')
                         ->with('success', 'Language created successfully.');
    }

    public function edit(Language $language)
    {
        return view('admin.language.edit', compact('language'));
    }

    public function update(Request $request, Language $language)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'code'   => 'required|string|max:10|unique:languages,code,' . $language->id,
            'flag'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $language->name = $request->name;
        $language->code = $request->code;
        $language->updated_id = Auth::id();
        $language->status = $request->status;

        // Handle flag update
        if ($request->hasFile('flag')) {
            // Delete old flag
            $this->deleteFlag($language);
            // Upload new flag
            $filename = $this->uploadFlag($request->file('flag'), $request->name);
            if ($filename) {
                $language->flag = $filename;
            } else {
                return back()->withInput()->with('error', 'Failed to upload new flag image.');
            }
        }

        $language->save();

        return redirect()->route('admin.language.index')
                         ->with('success', 'Language updated successfully.');
    }

    public function destroy(Language $language)
    {
        $this->deleteFlag($language);
        $language->delete();

        return redirect()->route('admin.language.index')
                         ->with('success', 'Language deleted successfully.');
    }

    /* ============================
       PRIVATE HELPERS
    ============================ */

    /**
     * Upload a flag image and return the filename.
     *
     * @param \Illuminate\Http\UploadedFile $flag
     * @param string $name  (language name, used for slug)
     * @return string|null  The saved filename, or null on failure.
     */
    private function uploadFlag($flag, string $name): ?string
    {
        try {
            $extension = $flag->getClientOriginalExtension();
            $filename = Str::slug($name) . '.' . $extension;

            $path = $flag->storeAs('flags', $filename, 'public');

            if (!$path) {
                // Log error if needed
                // \Log::error('Flag upload failed for ' . $name);
                return null;
            }

            return $filename;
        } catch (\Exception $e) {
            // Log exception if needed
            // \Log::error('Flag upload exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Delete the flag file if it exists.
     */
    private function deleteFlag(Language $language): void
    {
        if ($language->flag) {
            $path = 'flags/' . $language->flag;
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }
}