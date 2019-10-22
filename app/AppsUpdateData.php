<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppsUpdateData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS2015_apps_update_data';

  public static function getUpdateData()
  {
      $updateData = DB::connection($connection)
                            ->table($table)->get();

      return $updateData;
  }
}
