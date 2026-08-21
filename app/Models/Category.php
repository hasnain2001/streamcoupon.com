<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
protected $fillable = [
        'name',
        'slug',
        'top_category',
        'status',
        'image',
        'authentication',
        'title',
        'meta_keyword',
        'meta_description',
        'user_id',
        'updated_at',
        'created_id',
        'updated_id',
         'user_id',
    ];

    protected $casts = [
        'status' => 'boolean',
        'user_id' => 'integer',
        'updated_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }
     public function stores()
    {
        return $this->hasMany(Store::class, 'category_id');
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }
    public function getCreatedAtKarachiAttribute()
    {
        return $this->created_at->setTimezone('Asia/Karachi');
    }

    public function getUpdatedAtKarachiAttribute()
    {
        return $this->updated_at->setTimezone('Asia/Karachi');
    }
       public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return asset('assets/img/no-image-found.png');
        }

        // Check in the symlinked 'stores' folder inside public
        if (file_exists(public_path('storage/categories/' . $this->image))) {
            return asset('storage/categories/' . $this->image);
        }

        // Fallback to other locations (optional)
        if (Storage::disk('public')->exists('storage/categories/' . $this->image)) {
            return Storage::disk('public')->url('storage/categories/' . $this->image);
        }

        return asset('assets/img/no-image-found.png');
    }

}
