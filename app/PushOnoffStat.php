<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushOnoffStat extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS2016_push_onoff_stat';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  protected $fillable = [];

  public static function getPushOnoffStatData()
  {
      $pushOnoffStatData = DB::connection($connection)
      ->table($table)->get();

      return $pushOnoffStatData;
  }
}
