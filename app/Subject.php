<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Subject extends Authenticatable
{
    use Notifiable;

    protected $table = 'subjects';
    protected $guarded = ['id'];

    public function tracks()
    {
        return $this->hasMany('App\Track', 'subject_id');
    }

    public function time_tracks()
    {
        return $this->hasMany('App\TimeTrack', 'subject_id');
    }

    public function questionnaire()
    {
        return $this->hasOne('App\Questionnaire', 'subject_id');
    }
}
