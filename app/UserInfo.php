<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_user_info';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  protected $fillable = [];

  public static function getUserInfoData()
  {
      $userInfoData = DB::connection($connection)
      ->table($table)->get();

      return $userInfoData;
  }
}
