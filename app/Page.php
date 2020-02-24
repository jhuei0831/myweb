<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

    protected $primaryKey = 'id';

    protected $fillable = [
        "name", "navbar_id" ,"title", "url", "content", "is_open",
    ];

    public function navbars()
    {
        return $this->belongsTo('App\Navbar');
    }

    public function slides()
    {
        return $this->hasMany('App\Slide');
    }
}
