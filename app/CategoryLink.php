<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryLink extends Model
{
    protected $table = 'categorylinks';

    public function page()
    {
        return $this->belongsTo('App\Page', 'cl_from', 'page_id');
    }
}
