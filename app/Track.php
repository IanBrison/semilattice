<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $table = 'tracks';
    protected $fillable = ['subject_id', 'quiz_num', 'category_id', 'content_id'];
}
