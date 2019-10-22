<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppsPointMemberData;
use Yajra\Datatables\Datatables;

class AppsPointMemberController extends Controller
{
  public function getIndex()
  {
      return view('appspointmemberlist');
  }

  public function getAppsPointMemberListData()
  {
    $appspointmemberlistData = AppsPointMemberData::select('idx',
                                           'app_id',
                                           'app_name',
                                           'mem_id',
                                           'total_point',
                                           'app_os',
                                           'app_ver',
                                           'reg_time');

    return Datatables::of($appspointmemberlistData)
            ->setRowId(function($appspointmemberlistData) {
                return $appspointmemberlistData->idx;
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $appspointmemberData = AppsPointMemberData::where('idx', $idx)->first();

    return view('appspointmemberdetail')->with('appspointmemberData', $appspointmemberData);
  }
}
