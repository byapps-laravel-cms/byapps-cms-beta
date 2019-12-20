<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppsPaymentData;
use App\ResellerInfo;
use Yajra\Datatables\Datatables;

class ResellerPaymentController extends Controller
{
  public function getIndex()
  {
      return view('resellerpaymentlist');
  }

  public function getResellerPaymentListData()
  {
    $resellerPaymentListData = AppsPaymentData::select('idx',
                                                    'reg_time',
                                                    'recom_id',
                                                    'app_name',
                                                    'process',
                                                    'pay_type',
                                                    'term',
                                                    'start_time',
                                                    'amount'
                                                    );

    // * 쿼리 수정 필요
    return Datatables::of($resellerPaymentListData)
            ->setRowId(function($resellerPaymentListData) {
                return $resellerPaymentListData->idx;
            })
            // ->whereHas('payments', function (Builder $query) {
            //   $query->where('mem_id', '=', 'recom_id');
            // })
            ->editColumn('recom_id', function($eloquent) {
              if ($eloquent->recom_id != 'byapps' && $eloquent->recom_id != '' && $eloquent->recom_id != null)
                return $eloquent->recom_id;
            })
            ->editColumn('pay_type', function($eloquent) {
              if ($eloquent->pay_type == 1) {
                return "연장";
              } else {
                return "신규";
              }
            })
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

  public function getSingleData($idx)
  {
    $resellerPaymentData = AppsPaymentData::has('resellerinfo')->where('idx', $idx)->first();

    return view('resellerpaydetail')->with('resellerPaymentData', $resellerPaymentData);
  }
}
