<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TimeTrack extends Model
{
    protected $table = 'time_tracks';
    protected $guarded = ['id'];

    public function getTimeAttribute()
    {
        $start_time = new Carbon($this->start_time);
        $end_time = new Carbon($this->end_time);
        return $start_time->diffInSeconds($end_time);
    }
}
