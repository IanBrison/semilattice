<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'type'];

    public function childs()
    {
        return $this->belongsToMany('App\Category', 'category_connections', 'parent_category_id', 'child_category_id');
    }

    public function parents()
    {
        return $this->belongsToMany('App\Category', 'category_connections', 'child_category_id', 'parent_category_id');
    }
}
