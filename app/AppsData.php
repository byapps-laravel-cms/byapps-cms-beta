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
  protected $dates = ['reg_time','start_time','end_time'];
  protected $dateFormat = 'Y-m-d [h:i:s]';
  protected $fillable = ['app_process','service_type','app_os_type','byapps_ver','app_ver','app_build','app_ver_ios','app_build_ios','app_cate','noti_gcm','noti_gcm_num','noti_fcm_num','noti_ios_cerp','ios_cer_exp','ios_dev_exp','push_server','token','start_time','end_time','app_android_url','app_ios_url','surl','vender','hashkey','ioshack','host_id','txtencode','host_name','app_lang','auto_login','login_point','push_point','install_point','point_transfer_btn','cscall','app_intro','developer_info','modify_time'];

  public function asDateTime($value) {
      $result = date($this->getDateFormat(), $value);
      $this->setDateFormat('Y-m-d');
      return $result;
  }
  public function fromDateTime($value){
      if(gettype($value) == 'integer') return $value;
      $result = \Carbon\Carbon::createFromFormat('Y-m-d', $value);
      return $result->timestamp;
  }

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

  public function member()
  {
    return $this->hasOne('App\UserInfo','mem_id','mem_id');
  }

  public function downs()
  {
    return $this->hasOne('App\AppsDownStat','app_id','app_id');
  }

  public function userinfo()
  {
    return $this->belongsTo('App\UserInfo','mem_id');
  }
}
