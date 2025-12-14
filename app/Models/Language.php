<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'user_id',
        'updated_id',
        'name',
        'code',
        'flag',
        'status',
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
        return $this->hasMany(Store::class, 'language_id');
    }
    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'language_id');
    }

}
