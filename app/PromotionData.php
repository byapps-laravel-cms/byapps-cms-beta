<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class PromotionData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS2016_promotion_data';

  public static function getPaymentData()
  {
      $promotionData = DB::connection($connection)->table($table)->get();

      dd($promotionData);

      return $promotionData;
  }
}
