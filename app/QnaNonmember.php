<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QnaNonmember extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_cs_qna';

  public static function getQnaNonmemberData()
  {
      $qnaNonmemberData = DB::connection($connection)
                            ->table($table)->get();

      return $qnaNonmemberData;
  }
}
