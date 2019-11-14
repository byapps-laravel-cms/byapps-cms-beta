<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cafe24ApiToken extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_cafe24_api_token';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  public static function getCafe24ApiTokenData()
  {
      $cafe24ApiTokenData = DB::connection($connection)->table($table)->get();

      return $cafe24ApiTokenData;
  }
}
