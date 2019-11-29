<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppsPointMemberData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS2015_apps_point_member_data';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  protected $fillable = [];

  public static function getAppsPointMemberData()
  {
      $appsPointMemberData = DB::connection($connection)
      ->table($table)->get();

      return $appsPointMemberData;
  }
}
