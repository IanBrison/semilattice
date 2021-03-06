<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'type'];

    public $grand_parent;

    public function childs()
    {
        return $this->belongsToMany('App\Category', 'category_connections', 'parent_category_id', 'child_category_id');
    }

    public function parents()
    {
        return $this->belongsToMany('App\Category', 'category_connections', 'child_category_id', 'parent_category_id');
    }

    public function parent_connections()
    {
        return $this->hasMany('App\CategoryConnection', 'child_category_id');
    }

    public function child_connections()
    {
        return $this->hasMany('App\CategoryConnection', 'parent_category_id');
    }

    public function contents()
    {
        return $this->belongsToMany('App\Content', 'category_contents', 'category_id', 'content_id');
    }

    public function getParentConnectionToArrayAttribute()
    {
        return "[" . $this->parent_connections->pluck('parent_category_id')->implode(', ') . "]";
    }

    public function getChildConnectionToArrayAttribute()
    {
        return "[" . $this->child_connections->pluck('child_category_id')->implode(', ') . "]";
    }

    public function getIsSemilatticeCategoryAttribute()
    {
        $is_semilattice = false;
        $child_connection = $this->child_connections()->first();
        if ($child_connection != null && $child_connection->semilattice_name != null) $is_semilattice = true;

        return $is_semilattice;
    }
}
