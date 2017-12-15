<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Subject extends Authenticatable
{
    use Notifiable;

    protected $table = 'subjects';
    protected $fillable = ['name', 'uni_id'];

    public function tracks()
    {
        return $this->hasMany('App\Track', 'subject_id');
    }
}
