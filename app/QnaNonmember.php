<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QnaNonmember extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_myqna_data';

  public static function getQnaNonMemberData()
  {
      $qnaNonMemberData = DB::connection($connection)
                            ->table($table)->get();

      return $qnaNonMemberData;
  }
}
