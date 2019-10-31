<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\AppsPaymentData;

class SalesChartController extends Controller
{
  // 매출 통계 일간
  public function onGetSalesTermChartData(Request $request)
  {
    // mktime (시, 분, 초, 월, 일, 년)
    // $from = mktime(0, 0, 0, date("03"), date("d"), date("Y"));
    // $to = mktime(23, 59, 59, date("03"), date("d"), date("Y"));
    $from = strtotime($request->date1);
    $to = strtotime($request->date2);

    $salesTotal = AppsPaymentData::where('process', '=', '1')
                  ->whereBetween('reg_time', [$from, $to])
                  ->orderBy('idx', 'asc')
                  ->sum('amount');

    // 신규
    $salesNew = AppsPaymentData::where('process', '=', '1')
                ->whereBetween('reg_time', [$from, $to])
                ->orderBy('idx', 'asc')
                ->sum(DB::Raw("case when pay_type='0' then amount end"));

    // 연장
    $salesCon = AppsPaymentData::where('process', '=', '1')
                ->whereBetween('reg_time', [$from, $to])
                ->orderBy('idx', 'asc')
                ->sum(DB::Raw("case when pay_type='1' then amount end"));

    $salesEtc = $salesTotal - ($salesNew + $salesCon);

    $result = array(
      'bar' => array(
          array('전체', $salesTotal),
          array('신규', $salesNew),
          array('연장', $salesCon),
          array('기타', $salesEtc),
      )
    );

    return $result;
  }

  // 매출 통계
  public function onGetSalesChartData()
  {
    // 전체
    // origianl query: SELECT sum(amount) as total, sum(case when pay_type='0' then amount end) as newt, sum(case when pay_type='1' then amount end) as con
    //                 FROM BYAPPS_apps_payment_data where process=1 and (reg_time between '".get_mktime(date("Y-m")."-01-0-0-0")."' and '".get_mktime(date("Y-m")."-31-23-59-59")."')
    //                 order by idx asc
    // SELECT sum(amount) as total, sum(case when pay_type='0' then amount end) as newt, sum(case when pay_type='1' then amount end) as con
    // FROM BYAPPS_apps_payment_data where process=1 and (reg_time between unix_timestamp('2019-03-01 00:00:00') and unix_timestamp('2019-03-31 23:59:59')) order by idx asc

    $from = mktime(0, 0, 0, date("03"), 01, date("Y"));
    $to = mktime(23, 59, 59, date("03"), 31, date("Y"));

    $salesTotal = AppsPaymentData::where('process', '=', '1')
                  ->whereBetween('reg_time', [$from, $to])
                  ->orderBy('idx', 'asc')
                  ->sum('amount');

    // 신규
    $salesNew = AppsPaymentData::where('process', '=', '1')
                ->whereBetween('reg_time', [$from, $to])
                ->orderBy('idx', 'asc')
                ->sum(DB::Raw("case when pay_type='0' then amount end"));

    // 연장
    $salesCon = AppsPaymentData::where('process', '=', '1')
                ->whereBetween('reg_time', [$from, $to])
                ->orderBy('idx', 'asc')
                ->sum(DB::Raw("case when pay_type='1' then amount end"));

    $salesEtc = $salesTotal - ($salesNew + $salesCon);

    $result = array(
      'bar' => array(
          array('전체', $salesTotal),
          array('신규', $salesNew),
          array('연장', $salesCon),
          array('기타', $salesEtc),
      )
    );

    return $result;
  }

  public function onGetEntireSalesChartData(Request $request)
  {
    $from = strtotime($request->date1);
    $to = strtotime($request->date2);

    $result = array(
      'bar' => $this->onGetSalesTermChartData($request)['bar']
    );

    return $result;
  }

  public function index() {

    $result = array(
      'bar' => $this->onGetSalesChartData()['bar']
    );

    return $result;
  }
}
