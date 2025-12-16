<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
protected $fillable = [
        'name',
        'slug',
        'top_category',
        'status',
        'image',
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
        'status' => 'boolean'
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

}
