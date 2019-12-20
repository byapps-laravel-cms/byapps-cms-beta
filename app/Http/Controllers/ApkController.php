<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ApkData;
use Yajra\Datatables\Datatables;

class ApkController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getIndex()
  {
      return view('apklist');
  }

  public function getApkData()
  {
    $apkData = ApkData::select('idx',
                            'app_id',
                            'app_process',
                            'app_name',
                            'app_type',
                            'apk_file',
                            'reg_time');

	 $app_process = array("","대기","완료");

    return Datatables::of($apkData)
            ->setRowId(function($apkData) {
              return $apkData->idx;
            })
            ->editColumn('app_process', function($eloquent) use ($app_process){
              return $app_process[$eloquent->app_process];
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $apkData = ApkData::where('idx', $idx)->first();

    return view('apkdetail')->with('apkdata', $apkData);
  }

}
