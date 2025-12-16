<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'description',
        'store_id',
        'user_id',
        'updated_by',
        'clicks',
        'order',
        'status',
        'langauge_id'
    ];

    public function stores()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
   public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
     public function language()
    {
        return $this->belongsTo(Language::class, 'langauge_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
