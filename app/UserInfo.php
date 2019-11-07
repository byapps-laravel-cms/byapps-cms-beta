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

  public function order()
  {
    return $this->hasMany('App\AppsOrderData', 'mem_id');
  }

  public function apps()
  {
    return $this->hasMany('App\AppsData', 'mem_id');
  }

  public function payments()
  {
    return $this->hasMany('App\AppsPaymentData', 'mem_id');
  }
}
