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

    public function getAuthIdentifier()
	{
		return $this->getKey();
	}
}
