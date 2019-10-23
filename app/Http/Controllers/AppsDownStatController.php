<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\AppsDownStat;
use Yajra\Datatables\Datatables;

class AppsDownStatController extends Controller
{
  public function getIndex()
  {
      return view('appsdownstatlist');
  }

  public function getAppsDownStatListData()
  {
    $appsDownStatListData = AppsDownStat::select('idx',
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
                                             'reg_date');

    return Datatables::of($appsDownStatListData)
            ->setRowId(function($appsDownStatListData) {
                return $appsDownStatListData->idx;
            })
            ->editColumn('average', function($eloquent) {
                if ($eloquent->total_c > 1) {
                  // return ceil(($eloquent->total_c - $eloquent->today_c) / (ceil(UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP($eloquent->reg_date))/86400) -1);
                  $interval = date_diff(new DateTime(), new DateTime($eloquent->reg_date));
                  return ceil(($eloquent->total_c - $eloquent->today_c) / (ceil($interval->format('%a'))) -1);
                } else {
                  return 0;
                }
            })
            ->editColumn('term', function($eloquent) {
              return $eloquent->revisit_check." (".$eloquent->launch_date." ~ ".now().")";
            })
            ->orderColumn('reg_date', 'reg_date $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $appsDownStatData = AppsDownStat::where('idx', $idx)->first();

    return view('appsdownstatdetail')->with('appsDownStatData', $appsDownStatData);
  }
}
