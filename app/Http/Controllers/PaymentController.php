<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests;
use DB;
use App\PaymentData;
use Yajra\Datatables\Datatables;
//use App\DataTables\PaylistDataTable;

class PaymentController extends Controller
{
    public function getIndex()
    {
        return view('paylist');
    }

    public function getPaymentData()
    {
      $paymentData = PaymentData::select('idx', 'app_name', 'pay_type', 'term', 'amount', 'start_time', 'reg_time');

      return Datatables::of($paymentData)
              ->setRowId(function($paymentData) {
                return $paymentData->idx;
              })
              ->editColumn('pay_type', '{{ $pay_type == 1 ? "연장" : "신규" }}')
              ->editColumn('amount', '{{ number_format($amount)." 원" }}')
              ->editColumn('term', function($eloquent) {
                 if (empty($eloquent->start_time)) {
                   return $eloquent->term." 일(미정)";
                 } else {
                   return $eloquent->term." 일";
                 }
              })
              ->rawColumns([ 'term' ])
              ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
              ->orderColumn('reg_time', 'reg_time $1')
              ->make(true);
    }

}
