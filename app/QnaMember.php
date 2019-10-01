<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QnaMember extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_cs_qna';

  public static function getQnaMemberData()
  {
      $qnaMemberData = DB::connection($connection)
                            ->table($table)->get();

      return $qnaMemberData;
  }
}
