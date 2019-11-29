<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class UserInfo extends Model implements Searchable
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_user_info';
  protected $primaryKey = 'idx';
  public $timestamps = false;

  protected $fillable = [
    'mem_id', 'mem_email', 'passwd', 'mem_nick', 'mem_name', 'ceo_name', 'phoneno', 'cellno'
  ];

  public static function getUserInfoData()
  {
      $userInfoData = DB::connection($connection)
      ->table($table)->get();

      return $userInfoData;
  }

  public function getSearchResult(): SearchResult
  {
    $url = route('userinfodetail', $this->idx);

    return new SearchResult($this, $this->mem_name, $url);
  }

  public function order()
  {
    return $this->hasMany('App\AppsOrderData', 'mem_id');
  }

  public function apps()
  {
    return $this->hasMany('App\AppsData', 'mem_id');
  }

  public function payments()
  {
    return $this->hasMany('App\AppsPaymentData', 'mem_id');
  }
}
