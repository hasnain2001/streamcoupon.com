<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    protected $fillable = [
        'name',
        'title',
        'slug',
        'content',
        'image',
        'status',
        'top_blog',
        'meta_description',
        'meta_keyword',
        'category_id',
        'language_id',
        'store_id',
        'user_id',
        'updated_id',
    ];

    protected $casts = [
        'status' => 'boolean',
        'top_blog' => 'boolean',
        'language_id' => 'integer',
        'store_id' => 'integer',
        'category_id' => 'integer',
        'user_id' => 'integer',
        'updated_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $relations = [
        'user',
        'updatedby',
        'category',
        'language',
        'store',
    ];
    protected $dates = ['created_at','updated_at'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
 

    public function getImageUrlAttribute()
    {
            if (empty($this->image)) {
            return asset('assets/img/no-image-found.png');
            }

            // Check in the symlinked 'stores' folder inside public
            if (file_exists(public_path('storage/blogs/' . $this->image))) {
            return asset('storage/blogs/' . $this->image);
            }

            // Fallback to other locations (optional)
            if (Storage::disk('public')->exists('storage/blogs/' . $this->image)) {
            return Storage::disk('public')->url('storage/blogs/' . $this->image);
            }

            return asset('assets/img/no-image-found.png');
    }

     protected static function booted()
    {
        static::deleting(function ($blog) {
            $folder = "blogs/{$blog->id}";
            if (Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->deleteDirectory($folder);
            }
        });
    }

}
