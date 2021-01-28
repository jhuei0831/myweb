<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Notice extends Model
{
    use HasApiTokens, HasFactory;

    protected $guard_name = 'sanctum';

    protected $fillable = [
        'user_id',
        'priority',
        'title',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id', 'user_id');
    }
}
