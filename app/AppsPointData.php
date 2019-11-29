<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppsPointData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS2015_apps_point_data';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  protected $fillable = [];

  public static function getAppsPointData()
  {
      $appsPointData = DB::connection($connection)
      ->table($table)->get();

      return $appsPointData;
  }
}
