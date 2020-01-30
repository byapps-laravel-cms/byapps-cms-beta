<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AppsPaymentData;
use App\AppsOrderData;
use Yajra\Datatables\Datatables;
use Session;

class AppsPaymentController extends Controller
{
    public function getIndex()
    {
        return view('paylist');
    }

    public function getAppsPaymentData(Request $request)
    {
      $pay_type = array("신규", "연장", "", "추가", "기타", "충전");
      $pay_type = [
        '0' => '신규',
        '1' => '연장',
        '3' => '추가',
        '4' => '기타',
        '5' => '충전'
      ];

      if (isset($request->pay_type) && $request->pay_type >= 0) {
        $appsPaymentData = AppsPaymentData::select('idx',
                                                   'app_name',
                                                   'pay_type',
                                                   'term',
                                                   'amount',
                                                   'start_time',
                                                   'end_time',
                                                   'reg_time')
                                            ->where('pay_type', $request->pay_type);
      } else {
        $appsPaymentData = AppsPaymentData::select('idx',
                                                   'app_name',
                                                   'pay_type',
                                                   'term',
                                                   'amount',
                                                   'start_time',
                                                   'end_time',
                                                   'reg_time');
      }

      return Datatables::of($appsPaymentData)
              ->setRowId(function($appsPaymentData) {
                return $appsPaymentData->idx;
              })
              ->editColumn('pay_type', function($eloquent) use ($pay_type){
                return $pay_type[$eloquent->pay_type];
              })
              ->editColumn('amount', '{{ number_format($amount)." 원" }}')
              ->editColumn('term', function($eloquent) {
                 if (empty($eloquent->start_time)) {
                   return $eloquent->term." 일 (미정)";
                 } else {
                   return $eloquent->term." 일 (".date("Y-m-d", $eloquent->start_time)." ~ ".date("Y-m-d", $eloquent->end_time).")";
                 }
              })
              ->rawColumns([ 'term' ])
              ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
              ->orderColumn('reg_time', 'reg_time $1')
              ->make(true);
    }

    public function getSingleData($idx)
    {
      $appsPaymentData = AppsPaymentData::where('idx', $idx)->first();

      return view('appspaydetail')->with('appsPaymentData', $appsPaymentData);
    }

    public function update(Request $request, $idx)
    {
      $appsPaymentData = AppsPaymentData::where('idx', $idx)->first();

      $appsPaymentData->receipt = $request->input('receipt');
      $appsPaymentData->save();

      //Session::flash('success', '업데이트 성공');
      toastr()->success('업데이트 성공', '', ['timeOut' => 1000, 'positionClass' => 'toast-center-center']);

      return redirect()->back();
    }

    public function getAppsOrderIdx()
    {
      $memId = $_POST['mem_id'];
      $idx = AppsOrderData::where('mem_id', '=', $memId)->first();

      return $idx;
    }

    public function getAppsPaymentIdx()
    {
      $memId = $_POST['mem_id'];
      $idx = AppsPaymentData::where('mem_id', '=', $memId)->first();

      return $idx;
    }
}
