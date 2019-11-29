<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResellerInfo extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_reseller_info';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  protected $fillable = [];

  public static function getResellerInfoData()
  {
      $resellerInfoData = DB::connection($connection)
                            ->table($table)->get();

      return $resellerInfoData;
  }

  public function payments()
  {
    return $this->hasMany('App\AppsPaymentData', 'mem_id', 'recom_id');
  }
}
