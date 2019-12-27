<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_comment_data';
  protected $dates = ['reg_time'];
  protected $dateFormat = 'Y/m/d [h:i:s]';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  public static function getCommentsData()
  {
      $commentsData = DB::connection($connection)
                      ->table($table)->get();

      return $commentsData;
  }

  public function fromDateTime($value){
      return $value;
  }
}
