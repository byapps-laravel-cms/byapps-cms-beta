<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_comment_data';

  public static function getCommentsData()
  {
      $commentsData = DB::connection($connection)
                      ->table($table)->get();

      return $commentsData;
  }
}
