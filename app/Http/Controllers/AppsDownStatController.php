<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppsDownStatData;
use Yajra\Datatables\Datatables;

class AppsDownStatController extends Controller
{
  public function getIndex()
  {
      return view('appsdownstatlist');
  }

  public function getAppsDownStatListData()
  {
    $appsDownStatListData = AppsDownStatData::select('idx',
                                             'app_id',
                                             'app_name',
                                             'total_c',
                                             'today_c',
                                             'yesterday_c',
                                             'todate',
                                             'max_c',
                                             'max_c_date',
                                             'revisit_check',
                                             'launch_date',
                                             'reg_time');

    return Datatables::of($appsDownStatListData)
            ->setRowId(function($appsDownStatListData) {
                return $appsDownStatListData->idx;
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $appsDownStatData = AppsDownStatData::where('idx', $idx)->first();

    return view('appsdownstatdetail')->with('appsDownStatData', $appsDownStatData);
  }
}
