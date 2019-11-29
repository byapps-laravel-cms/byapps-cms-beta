<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppsData;
use App\MAData;

class ExpiredController extends Controller
{
    // iOS 계정 만료된 업체들
    public function getExpiredIos()
    {
      // original query: select app_id,app_name,ios_dev_exp from BYAPPS_apps_data where ios_dev_exp!='' and ios_dev_exp<'".$next_month."' order by ios_dev_exp
      $todate=date("Y-m-d");

      $data = AppsData::select('app_name', 'app_id', 'ios_dev_exp')
              ->where('ios_dev_exp', '!=', '')
              ->where('ios_dev_exp', '<', $todate)
              ->orderBy('ios_dev_exp')
              ->get();

      return $data;
    }

    // iOS 계정 만료예정 업체들
    public function getWillBeExpiredIos()
    {
      $next_month=date("Y-m-d",strtotime("now +30 day"));
      $todate=date("Y-m-d",strtotime("now +1 day"));

      return AppsData::select('app_name', 'app_id', 'ios_dev_exp')
                        ->where('ios_dev_exp', '!=', '')
                        ->whereBetween('ios_dev_exp', [$todate, $next_month])
                        ->orderBy('ios_dev_exp')
                        ->get();
    }

    // push 인증서 만료된 업체들
    public function getExpiredPush()
    {
      // push 인증서 만료
      // original query: select app_id,app_name,ios_cer_exp from BYAPPS_apps_data where ios_cer_exp!='' and ios_cer_exp<'".$next_month."' order by ios_cer_exp
      $todate=date("Y-m-d");

      return AppsData::select('app_name', 'app_id', 'ios_cer_exp')
              ->where('ios_cer_exp', '!=', '')
              ->where('ios_cer_exp', '<', $todate)
              ->orderBy('ios_cer_exp')
              ->get();
    }

    // push 인증서 만료예정 업체들
    public function getWillBeExpiredPush()
    {
      $next_month=date("Y-m-d",strtotime("now +20 day"));
      $todate=date("Y-m-d");

      return AppsData::select('app_name', 'app_id', 'ios_cer_exp')
              ->where('ios_cer_exp', '!=', '')
              ->whereBetween('ios_cer_exp', [$todate, $next_month])
              ->orderBy('ios_cer_exp')
              ->get();
    }

    // MA 서비스 만료된 업체들
    public function getExpiredMA()
    {
      // MA 서비스 만료
      // original query: S$next_month=time()+(86400*20);
      //$qry="select ma_id,app_name,end_time from BYAPPS_MA_data where app_process='3' and end_time>0 and end_time<'".$next_month."' order by end_time";
      $todate=time();
      $next_month=time()+(86400*20);

      return MaData::select('ma_id', 'app_name', 'end_time')
              ->where('app_process', '=', '3')
              ->where('end_time', '>', 0)
              ->where('end_time', '<', $todate)
              ->orderBy('end_time')
              ->get();
    }

    // MA 서비스 만료예정 업체들
    public function getWillBeExpiredMA()
    {
      $todate=time()+(86400*1);
      $next_month=time()+(86400*30);

      return MaData::select('ma_id', 'app_name', 'end_time')
              ->where('app_process', '=', '3')
              ->where('end_time', '>', 0)
              ->whereBetween('end_time', [$todate, $next_month])
              ->orderBy('end_time')
              ->get();
    }

    // 앱서비스 만료된 업체들
    public function getExpiredApps()
    {
      // original query: 없음
      $todate=time();

      return AppsData::select('app_name', 'app_id', 'end_time')
                        ->where('app_process', '=', '7')
                        ->where('end_time', '!=', '0')
                        ->where('end_time', '<', $todate)
                        ->orderBy('end_time')
                        ->get();
    }

    // 앱서비스 만료예정 업체들
    public function getWillBeExpiredApps()
    {
      // original query: 없음
      $todate=time();
      $next_month=time()+(86400*30);

      return AppsData::select('app_name', 'app_id', 'end_time')
                        ->where('app_process', '=', '7')
                        ->where('end_time', '!=', '0')
                        ->whereBetween('end_time', [$todate, $next_month])
                        ->orderBy('end_time')
                        ->get();
    }
}
