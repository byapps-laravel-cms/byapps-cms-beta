<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class AppsListData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_apps_data';

  public static function getAppsListData()
  {
      $appslistData = DB::connection($connection)->table($table)->get();

      dd($appslistData);

      return $appslistData;
  }
}
