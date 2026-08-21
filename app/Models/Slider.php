<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
class Slider extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'link',
        'sort_order',
        'status',
        'language_id',
        'user_id',
        'updated_id',
    ];
    protected $casts = [
        'status' => 'boolean',
        'language_id' => 'integer',
        'user_id' => 'integer',
        'updated_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
        protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }

      public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return asset('assets/img/no-image-found.png');
        }

        // Check in the symlinked 'stores' folder inside public
        if (file_exists(public_path('storage/sliders/' . $this->image))) {
            return asset('storage/sliders/' . $this->image);
        }

        // Fallback to other locations (optional)
        if (Storage::disk('public')->exists('storage/sliders/' . $this->image)) {
            return Storage::disk('public')->url('storage/sliders/' . $this->image);
        }

        return asset('assets/img/no-image-found.png');
    }
}
