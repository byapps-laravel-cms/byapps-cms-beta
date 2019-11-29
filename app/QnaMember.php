<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QnaMember extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_myqna_data';

  public static function getQnaMemberData()
  {
      $qnaMemberData = DB::connection($connection)
                            ->table($table)->get();

      return $qnaMemberData;
  }
}
