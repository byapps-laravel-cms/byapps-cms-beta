<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS2015_push_msg_data';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  protected $fillable = [];

  public static function getPushData()
  {
      $pushData = DB::connection($connection)
      ->table($table)->get();

      return $pushData;
  }
}
