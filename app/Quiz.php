<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';
    protected $fillable = ['content_id'];

    public function types()
    {
        return $this->belongsToMany('App\Type', 'quiz_types', 'quiz_id', 'type_id');
    }

    public function content()
    {
        return $this->belongsTo('App\Content', 'content_id');
    }
}
