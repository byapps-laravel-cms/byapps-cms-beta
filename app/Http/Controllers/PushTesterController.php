<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PushTesterData;
use Yajra\Datatables\Datatables;

class PushTesterController extends Controller
{
  public function getIndex()
  {
      return view('pushtesterlist');
  }

  public function getPushTesterListData()
  {
    $pushTesterListData = PushTesterData::select('idx',
                                             'app_id',
                                             'app_name',
                                             'app_udid',
                                             'device_id',
                                             'app_lang',
                                             'app_os',
                                             'app_ver',
                                             'reg_time');

    return Datatables::of($pushTesterListData)
            ->setRowId(function($pushTesterListData) {
                return $pushTesterListData->idx;
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $pushTesterData = PushTesterData::where('idx', $idx)->first();

    return view('pushtesterdetail')->with('pushtesterData', $pushTesterData);
  }
}
