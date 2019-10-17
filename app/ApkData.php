<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApkData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_apk_data';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  protected $fillable = [];

  public static function getApkData()
  {
      $apkData = DB::connection($connection)
      ->table($table)->get();

      return $apkData;
  }
}
