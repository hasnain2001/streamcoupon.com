<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    protected $fillable = [
        'name',
        'status',
        'user_id',
        'updated_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function updatedUser()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }
}
