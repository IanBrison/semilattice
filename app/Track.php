<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $table = 'tracks';
    protected $fillable = ['subject_id', 'quiz_id', 'category_id', 'content_id'];

    public function quiz()
    {
        return $this->belongsTo('App\Quiz','quiz_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function content()
    {
        return $this->belongsTo('App\Content', 'content_id');
    }
}
