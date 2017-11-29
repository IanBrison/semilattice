<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryConnection extends Pivot
{
    protected $table = 'category_connections';
    protected $fillable = ['parent_category_id', 'child_category_id', 'type'];
}
