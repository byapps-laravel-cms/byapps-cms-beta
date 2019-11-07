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
    $appsOrderData = AppsOrderData::select('idx',
                                         'app_process',
                                         'app_name',
                                         'app_company',
                                         'order_name',
                                         'cellno',
                                         'apps_type',
                                         'pay_way',
                                         'receipt',
                                         'reg_time');

    $app_process = array("주문취소","접수","주문확인","개발진행","앱등록","서비스중지","서비스해지","","취소요청","접수대기");

    return Datatables::of($appsOrderData)
            ->setRowId(function($appsOrderData) {
              return $appsOrderData->idx;
            })
            ->editColumn('receipt', function($eloquent) {
              if ($eloquent->receipt == '') {
                return "미발행";
              } else {
              //  return substr($eloquent->receipt, 0, 50);
              //  return str_replace("|","\n", $eloquent->receipt);
                return "발행";
              }
            })
            ->editColumn('app_process', function($eloquent) use ($app_process) {
              return $app_process[$eloquent->app_process];
            })

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
