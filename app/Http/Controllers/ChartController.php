<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\AppsData;
use App\MAData;
use App\AppsPaymentData;

class ChartController extends Controller
{
    // 앱 통계
    public function onGetAppChartData()
    {
      // 전체
      // original query: select count(*) from BYAPPS_apps_data where app_process='7' and ( service_type='lite' or ((end_time-".time().")/86400)>'0' )
      // select count(*) from BYAPPS_apps_data where app_process='7' and ( service_type='lite' or (end_time-unix_timestamp())>'0' )
      // select count(*) from BYAPPS_apps_data where app_process='7' and ( service_type='lite' or (end_time > unix_timestamp()))
      $appsTotal = AppsData::where('app_process', '=', '7')
                    ->where(function($query){
                      $query->where('service_type', '=', 'lite')->orWhere('end_time', '>', time());
                    })
                    ->count();

      // 유료
      // original query: select count(*) from (select order_id from BYAPPS_apps_data where app_process='7' and ( service_type='lite' or ((end_time-".time().")/86400)>'0') ) a
      //                 inner join (select order_id from BYAPPS_apps_payment_data where process='1' and amount>'0' group by order_id) b on a.order_id=b.order_id
      // 연장(pay_type = 1), 신규, 결제금액이 있는 경우, 서비스유효
      $appsPaid = DB::table('marutm1.BYAPPS_apps_data as A')
                  ->leftJoin('marutm1.BYAPPS_apps_payment_data as B', 'A.order_id', '=', 'B.order_id')
                  ->where('A.app_process', '=', '7')
                  //->selectRaw("'A.service_type' = 'lite' or 'A.end_time' > unix_timestamp()")
                  ->where(function($query){
                    $query->where('A.service_type', '=', 'lite')->orWhere('A.end_time', '>', time());
                  })
                  ->where('B.process', '=', '1')
                  ->where('B.amount', '>', '0')
                  ->distinct()
                  ->count('A.order_id');

      // 무료
      // 결제금액이 없는 경우, 관리업체가 아닌 경우(is_cherrypicker != Y), 서비스유효
      $appsFree = $appsTotal - $appsPaid;

      // 관리
      // original query: 없음
      // 관리업체에 체크(is_cherrypicker = Y), 서비스유효
      $appsCheck = 100;

      $result = array(
          'circle1' => array(
            array('무료', $appsFree),
            array('유료', $appsPaid),
            array('관리', $appsCheck),
          )
      );

      return $result;
    }

    public function onGetAppDailyChartData(Request $request)
    {
      // $result = array(
      //     'circle1' => array(
      //         array('무료', 300),
      //         array('유료', 200),
      //         array('관리', 100),
      //     )
      // );
      info($request);
      $date = strtotime($date);

      // 전체
      $appsTotal = AppsData::where('app_process', '=', '7')
                    ->where(function($query){
                      $query->where('service_type', '=', 'lite')->orWhere('end_time', '>', $date);
                    })
                    ->count();

      // 유료
      // 연장(pay_type = 1), 신규, 결제금액이 있는 경우, 서비스유효
      $appsPaid = DB::table('marutm1.BYAPPS_apps_data as A')
                  ->leftJoin('marutm1.BYAPPS_apps_payment_data as B', 'A.order_id', '=', 'B.order_id')
                  ->where('A.app_process', '=', '7')
                  //->selectRaw("'A.service_type' = 'lite' or 'A.end_time' > unix_timestamp()")
                  ->where(function($query){
                    $query->where('A.service_type', '=', 'lite')->orWhere('A.end_time', '>', $date);
                  })
                  ->where('B.process', '=', '1')
                  ->where('B.amount', '>', '0')
                  ->distinct()
                  ->count('A.order_id');

      // 무료
      // 결제금액이 없는 경우, 관리업체가 아닌 경우(is_cherrypicker != Y), 서비스유효
      $appsFree = $appsTotal - $appsPaid;

      // 관리
      // 관리업체에 체크(is_cherrypicker = Y), 서비스유효
      $appsCheck = 100;

      $result = array(
          'circle1' => array(
            array('무료', $appsFree),
            array('유료', $appsPaid),
            array('관리', $appsCheck),
          )
      );

      return $result;
    }

    // MA 통계
    public function onGetMaChartData()
    {
      // 전체
      // original query: select count(*) from BYAPPS_MA_data where app_process='3' and ((end_time-".time().")/86400)>'0'";
      $maTotal = MAData::where('app_process', '=', '3')
                  ->where('end_time', '>', time())
                  ->count();

      // 유료
      // original query: select count(*) from (select order_id from BYAPPS_MA_data where app_process='3' and ((end_time-".time().")/86400)>'0') a
      //                 inner join (select order_id from BYAPPS_apps_payment_data where process='1' and amount>'0' group by order_id) b on a.order_id=b.order_id
      // select count(*) from (select order_id from BYAPPS_MA_data where app_process='3' and ((end_time-unix_timestamp())/86400)>'0') a inner join (select order_id from BYAPPS_apps_payment_data where process='1' and amount>'0' group by order_id) b on a.order_id=b.order_id

      $maPaid = DB::table('marutm1.BYAPPS_MA_data as A')
                ->leftJoin('marutm1.BYAPPS_apps_payment_data as B', 'A.order_id', '=', 'B.order_id')
                ->where('A.app_process', '=', '3')
                ->where('A.end_time', '>', time())
                ->where('B.process', '=', '1')
                ->where('B.amount', '>', '0')
                ->distinct()
                ->count('A.order_id');

      // 무료
      $maFree = $maTotal - $maPaid;

      // 관리
      // original query: 없음
      $maCheck = 10;

      $result = array(
        'circle2' => array(
            array('무료', $maFree),
            array('유료', $maPaid),
            array('관리', $maCheck),
        )
      );

      return $result;
    }

    public function onGetMaDailyChartData()
    {
      $result = array(
        'circle2' => array(
            array('무료', 180),
            array('유료', 270),
            array('관리', 100),
        )
      );

      return $result;
    }

    // MA 통합 기본
    public function onGetMaIntegChartData()
    {
      $result = array(
        'circle3' => array(
            array('무료', 180),
            array('유료', 270),
            array('관리', 100),
        )
      );

      return $result;
    }

    // MA 통합 일간
    public function onGetMaIntegDailyChartData()
    {
      $result = array(
        'circle3' => array(
            array('무료', 180),
            array('유료', 270),
            array('관리', 100),
        )
      );

      return $result;
    }

    public function index() {

      $result = array(
        'circle1' => $this->onGetAppChartData()['circle1'],
        'circle2' => $this->onGetMaChartData()['circle2'],
        'circle3' => $this->onGetMaIntegChartData()['circle3']
      );

      return $result;
    }
}
