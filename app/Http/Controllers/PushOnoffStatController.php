<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\PushOnoffStat;
use Yajra\Datatables\Datatables;

class PushOnoffStatController extends Controller
{
  public function getIndex()
  {
      return view('pushonoffstatlist');
  }

  public function getPushOnoffStatListData()
  {
    $pushOnoffStatListData = PushOnoffStat::select('idx',
                                         'app_id',
                                         'app_os',
                                         'on_off',
                                         'total_c',
                                         'today_c',
                                         'yesterday_c',
                                         'todate',
                                         'max_c',
                                         'max_c_date',
                                         'launch_date',
                                         'reg_date');

    return Datatables::of($pushOnoffStatListData)
            ->setRowId(function($pushOnoffStatListData) {
                return $pushOnoffStatListData->idx;
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
              return " (".$eloquent->launch_date." ~ ".now().")";
            })
            ->orderColumn('reg_date', 'reg_date $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $pushOnoffStatData = PushOnoffStat::where('idx', $idx)->first();

    return view('pushonoffstatdetail')->with('pushOnoffStatData', $pushOnoffStatData);
  }
}
