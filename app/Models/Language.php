<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // 👈 add this

class Language extends Model
{
    protected $fillable = [
        'user_id',
        'updated_id',
        'name',
        'code',
        'flag',   
        'status',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'status' => 'boolean',
        'user_id' => 'integer',
        'updated_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
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
        return $this->hasMany(Store::class, 'language_id');
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'language_id');
    }

    /**
     * Get the flag URL attribute.
     * This creates $language->flag_url
     */

public function getFlagUrlAttribute()
{
    if (empty($this->flag)) {
        return asset('assets/img/no-image-found.png');
    }

    $filePath = 'storage/flags/' . $this->flag;

    // Check if the file exists in the public directory
    if (file_exists(public_path($filePath))) {
        return asset($filePath);
    }

    // Log a warning if the file is missing (optional)
    // \Log::warning('Flag file missing: ' . $this->flag);

    return asset('assets/img/no-image-found.png');
}
 protected static function booted()
    {
        static::deleting(function ($language) {
            $folder = "flags/{$language->id}";
            if (Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->deleteDirectory($folder);
            }
        });
    }

    // You can also keep a generic image_url if needed, but it's better to use flag_url
}