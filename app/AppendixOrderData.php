<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppendixOrderData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_appendix_order_data';

  public static function getAppendixOrderData()
  {
      $appendixOrderData = DB::connection($connection)
                              ->table($table)->get();

      return $appendixOrderData;
  }
}
