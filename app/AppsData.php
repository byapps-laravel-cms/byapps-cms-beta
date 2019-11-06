<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class AppsData extends Model implements Searchable
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_apps_data';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  protected $fillable = [];

  public static function getAppsData()
  {
      $appsData = DB::connection($connection)
      ->table($table)->get();

      return $appsData;
  }

  public function getSearchResult(): SearchResult
  {
    $url = route('appsdetail', $this->idx);

    return new SearchResult($this, $this->app_name, $url);
  }

  public function payments()
  {
    return $this->hasMany('App\AppsPaymentData','mem_id');
  }

  public function userinfo()
  {
    return $this->belongsTo('App\UserInfo','mem_id');
  }
}
