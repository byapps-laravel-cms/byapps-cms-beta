<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResellerInfo;
use Yajra\Datatables\Datatables;

class ResellerInfoController extends Controller
{
  public function getIndex()
  {
      return view('resellerinfolist');
  }

  public function getResellerInfoListData()
  {
    $resellerInfoListData = ResellerInfo::select('idx',
                                              'mem_id',
                                              'mem_lv',
                                              'company',
                                              'company_owner',
                                              'cellno',
                                              'mem_count',
                                              'ip',
                                              'reg_date'
                                              );

    return Datatables::of($resellerInfoListData)
            ->setRowId(function($resellerInfoListData) {
                return $resellerInfoListData->idx;
            })
            ->orderColumn('reg_date', 'reg_date $1')
            ->make(true);
    }

  public function getSingleData($idx)
  {
    $resellerInfoData = ResellerInfo::where('idx', $idx)->first();

    return view('resellerinfodetail')->with('resellerInfoData', $resellerInfoData);
  }
}
