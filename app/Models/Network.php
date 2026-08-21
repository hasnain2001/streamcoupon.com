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
    protected $casts = [
        'status' => 'boolean',
        'user_id' => 'integer',
        'updated_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
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
