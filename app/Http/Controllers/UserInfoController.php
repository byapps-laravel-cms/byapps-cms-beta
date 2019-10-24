<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserInfo;
use Yajra\Datatables\Datatables;

class UserInfoController extends Controller
{
  public function getIndex()
  {
      return view('userinfolist');
  }

  public function getUserInfoListData()
  {
    $userInfoListData = UserInfo::select('idx',
                                         'mem_id',
                                         'mem_level',
                                         'mem_nick',
                                         'mem_name',
                                         'cellno',
                                         'ip',
                                         'reg_date');

    return Datatables::of($userInfoListData)
            ->setRowId(function($userInfoListData) {
                return $userInfoListData->idx;
            })
            ->editColumn('term', function($eloquent) {
              return " (".$eloquent->launch_date." ~ ".now().")";
            })
            ->orderColumn('reg_date', 'reg_date $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $userInfoData = UserInfo::where('idx', $idx)->first();

    return view('userinfodetail')->with('userInfoData', $userInfoData);
  }
}
