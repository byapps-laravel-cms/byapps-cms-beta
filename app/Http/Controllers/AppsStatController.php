<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\AppsStat;
use Yajra\Datatables\Datatables;

class AppsStatController extends Controller
{
  public function getIndex()
  {
      return view('appsstatlist');
  }

  public function getAppsStatListData()
  {
    $appsStatListData = AppsStat::select('idx',
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

    return Datatables::of($appsStatListData)
            ->setRowId(function($appsStatListData) {
                return $appsStatListData->idx;
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
    $appsStatData = AppsStat::where('idx', $idx)->first();

    return view('appsstatdetail')->with('appsStatData', $appsStatData);
  }
}
