<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushSchedule extends Model
{
    protected $connection = 'byapps';
    protected $table = 'BYAPPS2015_push_schedule_data';
    protected $primaryKey = 'idx';
    public $timestamps = false;
    protected $fillable = [];
}
