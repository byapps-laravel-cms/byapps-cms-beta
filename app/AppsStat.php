<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppsStat extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_apps_stat';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  protected $fillable = [];

  public static function getAppsDownStatData()
  {
      $appsStatData = DB::connection($connection)
      ->table($table)->get();

      return $appsStatData;
  }
}
