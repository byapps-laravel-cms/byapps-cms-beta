<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AppsOrderData;
use Yajra\Datatables\Datatables;

class AppsOrderController extends Controller
{
  public function getIndex()
  {
      return view('appsorderlist');
  }

  public function getAppsOrderData()
  {
    $appsOrderData = PromotionData::select('idx',
                                         'app_process',
                                         'app_cate',
                                         'app_name',
                                         'app_company',
                                         'app_home_url',
                                         'order_name',
                                         'cellno',
                                         'apps_type',
                                         'pay_way',
                                         'receipt',
                                         'reg_time');

    return Datatables::of($appsOrderData)
            ->setRowId(function($appsOrderData) {
              return $appsOrderData->idx;
            })
            // ->editColumn('mem_name', function($eloquent) {
            //   return $eloquent->mem_name."(".$eloquent->mem_id.")";
            // })
            // ->editColumn('pm_used', function($eloquent) {
            //   if ($eloquent->pm_used == 0) return "미사용";
            //   else return "사용 ".date('Y-m-d', $eloquent->used_time);
            // })
            // ->editColumn('pm_target', function($eloquent) {
            //   if ($eloquent->pm_target == "ma") return "마케팅 오토메이션";
            //   else return "앱 서비스";
            // })
            // ->editColumn('pm_content', function($eloquent) {
            //   $preData = explode(":", $eloquent->pm_content);
            //   return "월 ".number_format($preData[0])."원 지정결제";
            // })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $appsOrderData = AppsOrderData::where('idx', $idx)->first();

    return view('appsorderdetail')->with('appsOrderData', $appsOrderData);
  }
}
