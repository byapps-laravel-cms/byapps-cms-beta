<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppendixOrderData;
use Yajra\Datatables\Datatables;

class AppendixOrderController extends Controller
{
  public function getIndex()
  {
      return view('appendixorderlist');
  }

  public function getAppendixOrderListData()
  {
    $appendixOrderListData = AppendixOrderData::select('idx',
                                             'app_process',
                                             'service_type',
                                             'pay_way',
                                             'receipt',
                                             'order_name',
                                             'app_company',
                                             'cellno',
                                             'reg_time');

    return Datatables::of($appendixOrderListData)
            ->setRowId(function($appendixOrderListData) {
                return $appendixOrderListData->idx;
            })
            ->editColumn('receipt', function($eloquent) {
              return $eloquent->receipt == '' ? "미발행" : "발행";
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $appendixOrderData = AppendixOrderData::where('idx', $idx)->first();

    return view('appendixorderdetail')->with('appendixOrderData', $appendixOrderData);
  }
}
