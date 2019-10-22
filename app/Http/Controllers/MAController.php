<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MAData;
use Yajra\Datatables\Datatables;

class MAController extends Controller
{
  public function getIndex()
  {
      return view('malist');
  }

  public function getMAListData()
  {
    $maListData = MAData::select('idx',
                                 'ma_id',
                                 'order_id',
                                 'app_name',
                                 'ma_ver',
                                 'service_type',
                                 'server_group',
                                 'app_process',
                                 'start_time',
                                 'end_time',
                                 'reg_time');

    return Datatables::of($maListData)
            ->setRowId(function($maListData) {
                return $maListData->idx;
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $maData = MAData::where('idx', $idx)->first();

    return view('madetail')->with('maData', $maData);
  }
}
