<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table = 'notices';

    protected $primaryKey = 'id';

    protected $fillable = [
        "title", "menu_id" , "content", "is_open",
    ];

    public function menus()
    {
        return $this->belongsTo('App\Menu');
    }
}
