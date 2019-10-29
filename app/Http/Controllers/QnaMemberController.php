<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QnaMember;
use Yajra\Datatables\Datatables;

class QnaMemberController extends Controller
{
  public function getIndex()
  {
      return view('qnamemberlist');
  }

  public function getQnaMemberListData()
  {
    $qnaMemberListData = QnaMember::select('idx',
                                  'process',
                                  'subject',
                                  'mem_name',
                                  'email',
                                  'phone',
                                  'reg_time'
                                  );

    return Datatables::of($qnaMemberListData)
            ->setRowId(function($qnaMemberListData) {
                return $qnaMemberListData->idx;
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
    }

  public function getSingleData($idx)
  {
    $qnaMemberData = QnaMember::where('idx', $idx)->first();

    return view('qnamemberdetail')->with('qnaMemberData', $qnaMemberData);
  }
}
