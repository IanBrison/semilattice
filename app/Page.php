<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'page';

    public function categories()
    {
        return $this->hasMany('App\CategoryLink', 'cl_from', 'page_id');
    }
}
