<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConnectionType extends Model
{
    protected $table = 'connection_types';
    protected $fillable = ['connection_id', 'type'];
}
