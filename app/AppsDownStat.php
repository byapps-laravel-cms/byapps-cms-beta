<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppsDownStat extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_apps_down_stat';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  protected $fillable = [];

  public static function getAppsDownStatData()
  {
      $appsDownStatData = DB::connection($connection)
      ->table($table)->get();

      return $appsDownStatData;
  }
}
