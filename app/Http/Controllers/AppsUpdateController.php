<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AppsUpdateData;
use Yajra\Datatables\Datatables;

class AppsUpdateController extends Controller
{
  public function getIndex()
  {
      return view('appsupdatelist');
  }

  public function getAppsUpdateData(Request $request)
  {
    $app_process = [
						'0' => "취소",
						'1' => "접수",
						'2' => "신청확인",
						'3' => "진행중",
						'4' => "심사중",
						'9' => "완료"
					];

    if (isset($request->app_process) && $request->app_process >= 0) {
      $appsupdateData = AppsUpdateData::select('idx',
                                      'reg_time',
                                      'update_process',
                                      'app_id',
                                      'app_name',
                                      'os',
                                      'update_type',
                                      'update_ver'
                                      )->where('update_process', $request->app_process);
    } else {
      $appsupdateData = AppsUpdateData::select('idx',
                                      'reg_time',
                                      'update_process',
                                      'app_id',
                                      'app_name',
                                      'os',
                                      'update_type',
                                      'update_ver'
                                      );
    }

    return Datatables::of($appsupdateData)
            ->setRowId(function($appsupdateData) {
              return $appsupdateData->idx;
            })
            ->editColumn('update_process', function($eloquent) use ($app_process){
              return $app_process[$eloquent->update_process];
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $appsupdateData = AppsUpdateData::find($idx);

    return view('appsupdatedetail')->with('appsupdateData', $appsupdateData);
  }

}
