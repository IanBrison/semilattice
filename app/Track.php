<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $table = 'tracks';
    protected $fillable = ['subject_id', 'quiz_num', 'category_id', 'content_id'];

    public function quiz()
    {
        return $this->hasOne('App\Quiz','quiz_id');
    }

    public function category()
    {
        return $this->hasOne('App\Category', 'category_id');
    }

    public function content()
    {
        return $this->hasOne('App\Content', 'content_id');
    }
}
