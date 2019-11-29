<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PushData;
use Yajra\Datatables\Datatables;

class PushController extends Controller
{
  public function getIndex()
  {
      return view('pushlist');
  }

  public function getPushListData()
  {
    $pushlistData = PushData::select('idx',
                                   'app_id',
                                  'app_name',
                                  'os',
                                  'msg',
                                  'send_gcm',
                                  'send_ios',
                                  'reg_time');

    return Datatables::of($pushlistData)
            ->setRowId(function($pushlistData) {
                return $pushlistData->idx;
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $pushData = PushData::where('idx', $idx)->first();

    return view('pushdetail')->with('pushData', $pushData);
  }
}
