<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

use App\UserInfo;

class AppsOrderData extends Model implements Searchable
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_apps_order_data';
  protected $primaryKey  = 'idx';

  public static function getAppsOrderData()
  {
      $appsOrderData = DB::connection($connection)
                            ->table($table)->get();

      return $appsOrderData;
  }

  public function getSearchResult(): SearchResult
  {
    $url = route('appsorderdetail', $this->idx);

    return new SearchResult($this, $this->app_company, $url, $this->reg_time);
  }

  public function userinfo()
  {
    return $this->belongsTo('App\UserInfo', 'mem_id');
  }
}
