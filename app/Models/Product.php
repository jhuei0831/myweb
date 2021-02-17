<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Product extends Model
{
    use HasApiTokens, HasFactory;

    protected $guard_name = 'sanctum';
    
    protected $fillable = [
        'name', 'detail', 'price', 'unit', 'discount', 'amount'
    ];
}
