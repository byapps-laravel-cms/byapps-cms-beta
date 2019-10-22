<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushTesterData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS2015_push_tester_data';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  protected $fillable = [];

  public static function getPushTesterData()
  {
      $pushTesterData = DB::connection($connection)
      ->table($table)->get();

      return $pushTesterData;
  }
}
