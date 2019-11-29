<?php

namespace App;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Admin extends User
{
    protected $connection = 'byapps';
    protected $table = 'BYAPPS_admin';
    protected $primaryKey = 'idx';
    public $timestamps = false;
    protected $dates = ['log_time'];
    protected $dateFormat = 'Y-m-d h:i:s';
    protected $fillable = ['log_time'];

    public function fromDateTime($value){
        if($value != 'now')return $value;
        return \Carbon\Carbon::now()->toDateTimeString();
    }

    public function getAuthIdentifier()
	{
		return $this->getKey();
	}
}
