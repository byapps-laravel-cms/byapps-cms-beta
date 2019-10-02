<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AppsOrderData;
use App\AppendixOrderData;
use App\UpdateData;
use App\QnaMember;
use App\QnaNonmember;

class StatusController extends Controller
{
  /* 어제 대비 퍼센트 계산 */
  public function calculatePercent($date = '')
  {
    // 넘겨받는 날짜가 있으면 해당 날짜를 unix_timestamp로 변경. 없으면 오늘 날짜를 계산
    //
    if ($date == '') {
      $todate = time();
      $yesterday = time() - 86400;
    } else {
      $todate = strtotime($date);
      $yesterday = strtotime('-1 day', $todate);
      // info($todate);
      // info($yesterday);
    }

  }


  /* 주문(앱)접수 */
  /* date = yyyy-mm-dd  */
  public function onGetAppsOrderCount($date = '')
  {
    // 넘겨받는 날짜가 있으면 해당 날짜를 unix_timestamp로 변경. 없으면 오늘 날짜를 계산
    if ($date == '') {
      $todate = time();
    } else {
      $todate = strtotime($date);
    }

    //info(date('Y-m-d', $todate));

    // AppsOrderData::where('app_process', 1)->where('reg_time', '>=', time())->count();
    $appsOrderCount = AppsOrderData::where('app_process', 1)->where('reg_time', '>=', $todate)->count();

    return $appsOrderCount;
  }

  /* 부가서비스 접수 */
  public function onGetAppendixOrderCount($date = '')
  {
    // 넘겨받는 날짜가 있으면 해당 날짜를 unix_timestamp로 변경. 없으면 오늘 날짜를 계산
    if ($date == '') {
      $todate = time();
    } else {
      $todate = strtotime($date);
    }

    // AppendixOrderData::where('app_process', 1)->where('reg_time', '>=', time())->count();
    $appendixOrderCount = AppendixOrderData::where('app_process', 1)->where('reg_time', '>=', $todate)->count();

    return $appendixOrderCount;
  }

  /* 업데이트 접수 */
  public function onGetUpdateCount($date = '')
  {
    // 넘겨받는 날짜가 있으면 해당 날짜를 unix_timestamp로 변경. 없으면 오늘 날짜를 계산
    if ($date == '') {
      $todate = time();
    } else {
      $todate = strtotime($date);
    }

    // original query: select sum(case when update_process='1' then 1 else 0 end) order_no, sum(case when update_process='2' then 1 else 0 end) confirm_no,  sum(case when update_process='3' then 1 else 0 end) app_no
    // from BYAPPS2015_apps_update_data where (update_process='1' or update_process='2' or update_process='3') and reg_time>='".$search_time."'
    $updateCount = UpdateData::where('app_process', 1)->where('reg_time', '>=', $todate)->count();
    // UpdateData::where('app_process', 1)->where('reg_time', '>=', time())->count();

    return $updateCount;
  }

    // 회원문의
    // $nonmemberCount = QnaNonmember::where('process', 1)->count();
    // $memberCount = QnaMember::where('process', 1)->count();
}
