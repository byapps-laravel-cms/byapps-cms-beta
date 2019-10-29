<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QnaNonmember;
use Yajra\Datatables\Datatables;

class QnaNonmemberController extends Controller
{
  public function getIndex()
  {
      return view('qnanonmemberlist');
  }

  public function getQnaNonmemberListData()
  {
    $qnaNonmemberListData = QnaNonmember::select('idx',
                                  'process',
                                  'company',
                                  'name',
                                  'email',
                                  'phone',
                                  'reg_date'
                                  );

    return Datatables::of($qnaNonmemberListData)
            ->setRowId(function($qnaNonmemberListData) {
                return $qnaNonmemberListData->idx;
            })
            ->orderColumn('reg_date', 'reg_date $1')
            ->make(true);
    }

  public function getSingleData($idx)
  {
    $qnaNonmemberData = QnaNonmember::where('idx', $idx)->first();

    return view('qnanonmemberdetail')->with('qnaNonmemberData', $qnaNonmemberData);
  }
}
