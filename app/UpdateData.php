<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpdateData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_apps_update_data';

  public static function getUpdateData()
  {
      $updateData = DB::connection($connection)
                            ->table($table)->get();

      return $updateData;
  }
}
