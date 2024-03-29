<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $primaryKey = 'id';

    protected $fillable = [
        "user", "ip", "os", "browser", "browser_detail", "data", "action", "table", "created_at", "updated_at"
    ];

    // protected $hidden = [
    //     "data"
    // ];
}
