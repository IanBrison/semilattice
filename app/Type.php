<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';
    protected $fillable = ['type_num'];

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_types', 'type_id', 'category_id');
    }

    public function quizzes()
    {
        return $this->belongsToMany('App\Quiz', 'quiz_types', 'type_id', 'quiz_id');
    }
}
