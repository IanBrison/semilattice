<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryConnection extends Model
{
    protected $table = 'category_connections';
    protected $fillable = ['parent_category_id', 'child_category_id', 'type'];

    public function types()
    {
        return $this->hasMany('App\ConnectionType', 'connection_id');
    }
}
