<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AppsOrderData;
use App\ResellerInfo;
use Yajra\Datatables\Datatables;

class AppsOrderController extends Controller
{
  public function getIndex()
  {
      return view('appsorderlist');
  }

  public function getAppsOrderData(Request $request)
  {
    $app_process = array("주문취소","접수","주문확인","개발진행","앱등록","서비스중지","서비스해지","","취소요청","접수대기");
  	$app_process = [
  						'0' => "주문취소",
  						'1' => "접수",
  						'2' => "주문확인",
  						'3' => "개발진행",
  						'4' => "앱등록",
  						'5' => "서비스중지",
  						'6' => "서비스해지",
  						'8' => "취소요청",
  						'9' => "완료"
  					];

    if (isset($request->app_process) && $request->app_process >= 0) {
      $appsOrderData = AppsOrderData::select('idx',
                                           'app_process',
                                           'app_name',
                                           'app_company',
                                           'order_name',
                                           'cellno',
                                           'apps_type',
                                           'pay_way',
                                           'receipt',
                                           'reg_time')
                                        ->where('app_process', $request->app_process);
    } else {
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
    }

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

    $recom_id = AppsOrderData::where('idx', $idx)->select('recom_id')->get();
    if ($recom_id) {
      $recom_id = $recom_id[0]['recom_id'];
      $resellerData = ResellerInfo::where('mem_id', $recom_id)->first();
    }

    return view('appsorderdetail')->with('appsOrderData', $appsOrderData)
                                  ->with('resellerData', $resellerData);
  }
}
