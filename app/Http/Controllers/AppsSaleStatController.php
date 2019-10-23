<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\AppsSaleStat;
use Yajra\Datatables\Datatables;

class AppsSaleStatController extends Controller
{
  public function getIndex()
  {
      return view('appssalestatlist');
  }

  public function getAppsSaleStatListData()
  {
    $appsSaleStatListData = AppsSaleStat::select('idx',
                                         'app_id',
                                         'app_name',
                                         'total_c',
                                         'today_c',
                                         'yesterday_c',
                                         'total_m',
                                         'today_m',
                                         'yesterday_m',
                                         'todate',
                                         'max_c',
                                         'max_c_date',
                                         'max_m',
                                         'max_m_date',
                                         'revisit_check',
                                         'launch_date',
                                         'reg_date');

    return Datatables::of($appsSaleStatListData)
            ->setRowId(function($appsSaleStatListData) {
                return $appsSaleStatListData->idx;
            })
            ->editColumn('total_c', function($eloquent) {
              return $eloquent->total_c."<br>".$eloquent->total_m;
            })
            ->editColumn('today_c', function($eloquent) {
              return $eloquent->today_c."<br>".$eloquent->today_m;
            })
            ->editColumn('yesterday_c', function($eloquent) {
              return $eloquent->yesterday_c."<br />".$eloquent->yesterday_m;
            })
            ->editColumn('max_c', function($eloquent) {
              return $eloquent->max_c."<br />".$eloquent->max_m;
            })
            ->editColumn('average', function($eloquent) {
                if ($eloquent->total_c > 1) {
                  // return ceil(($eloquent->total_c - $eloquent->today_c) / (ceil(UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP($eloquent->reg_date))/86400) -1);
                  $interval = date_diff(new DateTime(), new DateTime($eloquent->reg_date));
                  $avg_c = ceil(($eloquent->total_c - $eloquent->today_c) / (ceil($interval->format('%a'))) -1);
                } else {
                  $avg_c = 0;
                }

                if ($eloquent->total_m > 1) {
                  $interval = date_diff(new DateTime(), new DateTime($eloquent->reg_date));
                  $avg_m = ceil(($eloquent->total_m - $eloquent->today_m) / (ceil($interval->format('%a'))) -1);
                } else {
                  $avg_m = 0;
                }

                return $avg_c."<br />".$avg_m;
            })
            ->editColumn('term', function($eloquent) {
              return $eloquent->revisit_check." (".$eloquent->launch_date." ~ ".now().")";
            })
            ->orderColumn('reg_date', 'reg_date $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $appsSaleStatData = AppsSaleStat::where('idx', $idx)->first();

    return view('appssalestatdetail')->with('appsSaleStatData', $appsSaleStatData);
  }
}
