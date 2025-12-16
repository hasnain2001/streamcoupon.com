<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
   /** @use HasFactory<\Database\Factories\StoreFactory> */
    use HasFactory;

        protected $fillable = [
        'name',
        'url',
        'destination_url',
        'top_store',
        'description',
        'about',
        'slug',
        'top_category',
        'status',
        'image',
        'title',
        'meta_keyword',
        'meta_description',
        'created_at',
        'updated_at',
        'deleted_at',
        'content',
          'user_id',
        'category_id',
        'updated_id',
        'network_id',
        'language_id',

    ];
    protected $dates =
    [
    'updated_at',
    'created_at',
    ];
    protected $casts = [
    'updated_at' => 'datetime',
    'created_at' => 'datetime',
    ];
    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'store_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
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
     public function network()
    {
        return $this->belongsTo(Network::class, 'network_id');
    }

}
