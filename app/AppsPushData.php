<?php
/*
	생성자 : 박현우
	생성일 : 2019-12-26
	푸시 데이터 테이블
*/

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppsPushData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS2015_push_data';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  protected $fillable = [];

  public static function getAppsPushData()
  {
      $appsPushData = DB::connection($connection)
      ->table($table)->get();

      return $appsPushData;
  }
}
