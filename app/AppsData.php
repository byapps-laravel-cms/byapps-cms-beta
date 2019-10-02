<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppsData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_apps_data';

  public static function getAppsData()
  {
      $appsData = DB::connection($connection)
      ->table($table)->get();

      //Log::info($paymentData);
      //dd($paymentData);

      return $appsData;
  }
}
