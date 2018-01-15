<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'contents';
    protected $guarded = ['id'];
    public $last_categories;

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_contents', 'content_id', 'category_id');
    }
}
