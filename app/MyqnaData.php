<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyqnaData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_myqna_data';
  protected $primaryKey = 'idx';
  public $timestamps = false;
}
