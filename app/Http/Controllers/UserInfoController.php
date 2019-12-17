<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserInfo;
use App\AppsData;
use App\AppsOrderData;
use App\ResellerInfo;
use Yajra\Datatables\Datatables;

class UserInfoController extends Controller
{
  public function getIndex()
  {
      return view('userinfolist');
  }

  public function getUserInfoListData()
  {
    $userInfoListData = UserInfo::select(
                                         'idx',
                                         'mem_id',
                                         'mem_nick',
                                         'mem_name',
                                         'cellno',
                                         'ip',
                                         'reg_date'
                                      );

    $orderProcess = array('주문취소','접수', '주문확인',
                        '개발진행', '앱등록', '서비스중지',
                        '서비스해지',  '', '', '접수대기');

    return Datatables::of($userInfoListData)
            ->setRowId(function($userInfoListData) {
                return $userInfoListData->idx;
            })
            ->editColumn('type', function($eloquent) use ($orderProcess) {

              $appsOrderData = AppsOrderData::select('app_process', 'mem_id')->where('mem_id', '=', $eloquent->mem_id)->first();
              $appsData = AppsData::select('app_process', 'mem_id', 'end_time')->where('mem_id', '=', $eloquent->mem_id)->first();

                if ($appsData['app_process'] == 7 && $appsData['end_time'] <= 0) {
                    return "만료";
                  } else if ($appsOrderData['app_process']) {
                    return $orderProcess[$appsOrderData['app_process']];
                  } else {
                    return "미고객";
                  }

            })
            ->editColumn('term', function($eloquent) {
              return " (".$eloquent->launch_date." ~ ".now().")";
            })
            //->orderColumn('reg_date', 'reg_date $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $userInfoData = UserInfo::find($idx);
    if($userInfoData == null)abort(404);

    $recom_id = UserInfo::where('idx', $idx)->select('recom_id')->get();
    $recom_id = $recom_id[0]['recom_id'];
    $resellerData = ResellerInfo::where('mem_id', $recom_id)->first();

    return view('userinfodetail')->with('userInfoData', $userInfoData)
                                 ->with('resellerData', $resellerData);
  }

  public function update(Request $request, $idx)
  {
    $userInfoData = UserInfo::where('idx', $idx)->first();

    $userInfoData->mem_id = $request->input('mem_id');
    $userInfoData->mem_name = $request->input('mem_name');
    $userInfoData->mem_nick = $request->input('mem_nick');
    $userInfoData->mem_email = $request->input('mem_email');
    $userInfoData->save();

    //Session::flash('success', '업데이트 성공');
    toastr()->success('업데이트 성공', '', ['timeOut' => 1000, 'positionClass' => 'toast-center-center']);

    return redirect()->back();
  }
}
