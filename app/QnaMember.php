<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QnaMember extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_myqna_data';
  protected $primaryKey = 'idx';
  public $timestamps = false;
  
  protected $fillable = [
    'pid', 'email', 'mem_name', 'attach_file', 'reg_time'
  ];



  public static function getQnaMemberData()
  {
      $qnaMemberData = DB::connection($connection)
                            ->table($table)->get();

      return $qnaMemberData;
  }
}
