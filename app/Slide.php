<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = 'slides';

    protected $primaryKey = 'id';

    protected $fillable = [
        "name", "page_id" ,"image", "sort", "is_open",
    ];

    public function pages()
    {
        return $this->belongsTo('App\Page');
    }
}
