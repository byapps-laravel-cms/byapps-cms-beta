<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppsSaleStat extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_apps_sale_stat';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  protected $fillable = [];

  public static function getAppsDownStatData()
  {
      $appsSaleStatData = DB::connection($connection)
      ->table($table)->get();

      return $appsSaleStatData;
  }
}
