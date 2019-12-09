<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MAData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_MA_data';
  protected $primaryKey = 'idx';
  public $timestamps = false;
  protected $dates = ['reg_time','start_time','end_time'];
  protected $dateFormat = 'Y-m-d';
  protected $fillable = ['app_process','ma_ver','auto_push','service_ma','service_type','start_time','end_time','start_time','pn','aid','schm','push_center','txtencode','host_name','app_lang','opt_sst','vip_check','info'];

  public function fromDateTime($value){
      if(gettype($value) == 'integer') return $value;
      $result = \Carbon\Carbon::createFromFormat('Y-m-d', $value);
      return $result->timestamp;
  }

  public function member()
  {
    return $this->hasOne('App\UserInfo','mem_id','mem_id');
  }
}
