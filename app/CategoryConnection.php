<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryConnection extends Model
{
    protected $table = 'category_connections';
    protected $guarded = ['id'];
}
