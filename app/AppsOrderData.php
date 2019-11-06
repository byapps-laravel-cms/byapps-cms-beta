<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\UserInfo;

class AppsOrderData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_apps_order_data';

  public static function getAppsOrderData()
  {
      $appsOrderData = DB::connection($connection)
                            ->table($table)->get();

      return $appsOrderData;
  }

  public function userinfo()
  {
    return $this->belongsTo('App\UserInfo', 'mem_id');
  }
}
