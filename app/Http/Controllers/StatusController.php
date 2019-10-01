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
  /* 주문(앱)접수 */
  public function onGetAppsOrderCount()
  {
    // AppsOrderData::where('app_process', 1)->where('reg_time', '>=', time())->count();
    $appsOrderCount = AppsOrderData::where('app_process', 1)->count();

    return $appsOrderCount;
  }

  /* 부가서비스 접수 */
  public function onGetAppendixOrderCount()
  {
    // AppendixOrderData::where('app_process', 1)->where('reg_time', '>=', time())->count();
    $appendixOrderCount = AppendixOrderData::where('app_process', 1)->count();

    return $appendixOrderCount;
  }

  /* 업데이트 접수 */
  public function onGetUpdateCount()
  {
    // original query: select sum(case when update_process='1' then 1 else 0 end) order_no, sum(case when update_process='2' then 1 else 0 end) confirm_no,  sum(case when update_process='3' then 1 else 0 end) app_no
    // from BYAPPS2015_apps_update_data where (update_process='1' or update_process='2' or update_process='3') and reg_time>='".$search_time."'
    $updateCount = UpdateData::where('app_process', 1)->count();
    // UpdateData::where('app_process', 1)->where('reg_time', '>=', time())->count();

    return $updateCount;
  }

    // 회원문의
    // $nonmemberCount = QnaNonmember::where('process', 1)->count();
    // $memberCount = QnaMember::where('process', 1)->count();
}
