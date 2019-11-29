<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MAData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_MA_data';

  public static function getAppsData()
  {
      $appsData = DB::connection($connection)
      ->table($table)->get();

      return $appsData;
  }
}
