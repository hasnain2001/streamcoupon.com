<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Store;


class SliderController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Slider::with('language')
            ->orderBy('sort_order', 'asc');

        // Status filter
        if ($request->has('status')) {
            $status = $request->status === 'active' ? 1 : 0;
            $query->where('status', $status);
        }

        // Language filter
        if ($request->has('language')) {
            $query->whereHas('language', function($q) use ($request) {
                $q->where('code', $request->language);
            });
        }

        // Get all languages for filter dropdown
        $languages = Language::all();

        // Paginate results (15 items per page by default)
        $sliders = $query->paginate($request->per_page ?? 15)
            ->appends($request->query());

        return view('employee.slider.index', compact('sliders', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = language::orderBy('created_at','desc')->get();
        $stores = Store::orderBy('created_at','desc')->get();
        return view('employee.slider.create',compact('languages','stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:2255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link' => 'nullable|url',
            'status' => 'required|boolean',
            'sort_order' => 'required|integer',
            'button_text' => 'nullable|string|max:50',
            'store_id' => 'required|exists:stores,id',
            'language_id' => 'required|exists:languages,id',
        ]);

        /* ---------------------------
        1️⃣ Save Slider Data
        ----------------------------*/
        $slider = new Slider();
        $slider->language_id = $request->language_id;
        $slider->store_id = $request->store_id;
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->link = $request->link;
        $slider->status = $request->status;
        $slider->sort_order = $request->sort_order;
        $slider->button_text = $request->button_text;
        $slider->save(); // get ID if needed later

        /* ---------------------------
        2️⃣ Handle Image Upload
        ----------------------------*/
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            // Folder path
            $destinationPath = public_path('uploads/sliders');

            // Create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Image name (SEO friendly)
            $slug = Str::slug($request->title);
            $imageName = $slug . '-' . time() . '.' . $image->getClientOriginalExtension();

            // Move image
            $image->move($destinationPath, $imageName);

            // Save image name in DB
            $slider->image = $imageName;
            $slider->save();
        }

        return redirect()
            ->route('employee.slider.index')
            ->with('success', 'Slider created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function edit(Slider $slider)
    {
        $languages = language::orderBy('created_at', 'desc')->get();
        $stores = Store::orderBy('created_at','desc')->get();
        return view('employee.slider.edit', compact('slider', 'languages','stores'));
    }
    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Slider $slider)
    {
            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'link' => 'nullable|url',
                'status' => 'required|boolean',
                'sort_order' => 'required|integer',
                'button_text' => 'nullable|string|max:50',
                'store_id' => 'required|exists:stores,id',
                'language_id' => 'required|exists:languages,id',
            ]);

            /* ---------------------------
            1️⃣ Update Slider Data
            ----------------------------*/
            $slider->language_id = $request->language_id;
            $slider->store_id = $request->store_id;
            $slider->title = $request->title;
            $slider->subtitle = $request->subtitle;
            $slider->link = $request->link;
            $slider->status = $request->status;
            $slider->sort_order = $request->sort_order;
            $slider->button_text = $request->button_text;

            /* ---------------------------
            2️⃣ Handle Image Upload
            ----------------------------*/
            if ($request->hasFile('image')) {

                $destinationPath = public_path('uploads/sliders');

                // Create directory if not exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Delete old image
                if (!empty($slider->image)) {
                    $oldImagePath = $destinationPath . '/' . $slider->image;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $image = $request->file('image');

                // SEO + unique image name
                $slug = Str::slug($request->title);
                $imageName = $slug . '-' . time() . '.' . $image->getClientOriginalExtension();

                // Move image
                $image->move($destinationPath, $imageName);

                // Save new image name
                $slider->image = $imageName;
            }

            $slider->save();

            return redirect()
                ->route('employee.slider.index')
                ->with('success', 'Slider updated successfully.');
    }



public function destroy(Slider $slider)
{
    // 🗑 Delete image from public/uploads/sliders
    if (!empty($slider->image)) {
        $imagePath = public_path('uploads/sliders/' . $slider->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // ❌ Delete DB record
    $slider->delete();

    return redirect()
        ->route('employee.slider.index')
        ->with('success', 'Slider deleted successfully.');
}
public function deleteSelected(Request $request)
{
    $ids = $request->input('ids');

    if (!empty($ids)) {
        foreach ($ids as $id) {
            $slider = Slider::find($id);

            if ($slider) {
                // 🗑 Delete image
                if (!empty($slider->image)) {
                    $imagePath = public_path('uploads/sliders/' . $slider->image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

                // ❌ Delete slider
                $slider->delete();
            }
        }
    }

    return redirect()
        ->route('employee.slider.index')
        ->with('success', 'Selected sliders deleted successfully.');
}

public function export(Request $request)
{
    $query = Slider::query();

    // Apply filters
    if ($request->filled('status')) {
        $status = $request->status === 'active' ? 1 : 0;
        $query->where('status', $status);
    }

    if ($request->filled('language')) {
        $query->whereHas('language', function ($q) use ($request) {
            $q->where('code', $request->language);
        });
    }

    $sliders = $query->get();

    $fileName = 'sliders-' . now()->format('Y-m-d') . '.csv';

    $headers = [
        "Content-Type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Cache-Control"       => "no-store, no-cache",
    ];

    $columns = [
        'ID',
        'Title',
        'Image',
        'Status',
        'Link',
        'Sort Order',
        'Language',
        'Created At',
    ];

    $callback = function () use ($sliders, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($sliders as $slider) {
            fputcsv($file, [
                $slider->id,
                $slider->title,
                $slider->image
                    ? asset('uploads/sliders/' . $slider->image)
                    : 'No Image',
                $slider->status ? 'Active' : 'Inactive',
                $slider->link,
                $slider->sort_order,
                $slider->language->name ?? 'N/A',
                $slider->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

}
