<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizSet extends Model
{
    protected $table = 'quiz_sets';

    protected $fillable = ['quiz_a_id', 'quiz_b_id'];

    public function a()
    {
        return $this->belongsTo('App\Quiz', 'quiz_a_id');
    }

    public function b()
    {
        return $this->belongsTo('App\Quiz', 'quiz_b_id');
    }
}
