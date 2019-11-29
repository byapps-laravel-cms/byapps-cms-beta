<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppsPointData;
use Yajra\Datatables\Datatables;

class AppsPointController extends Controller
{
  public function getIndex()
  {
      return view('appspointlist');
  }

  public function getAppsPointListData()
  {
    $appspointlistData = AppsPointData::select('idx',
                                             'app_id',
                                             'app_name',
                                             'mem_id',
                                             'point',
                                             'point_title',
                                             'reg_time');

    return Datatables::of($appspointlistData)
            ->setRowId(function($appspointlistData) {
                return $appspointlistData->idx;
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            // ->orderColumn('reg_time', 'reg_time $1')
            // ->orderColumn('idx')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $appspointData = AppsPointData::where('idx', $idx)->first();

    return view('appspointdetail')->with('appspointData', $appspointData);
  }
}
