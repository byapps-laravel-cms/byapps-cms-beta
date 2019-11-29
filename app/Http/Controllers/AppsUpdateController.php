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

  public function getAppsUpdateData()
  {
    $appsupdateData = AppsUpdateData::select('idx',
                                    'reg_time',
                                    'update_process',
                                    'app_id',
                                    'app_name',
                                    'os',
                                    'update_type',
                                    'update_ver'
                                    );

    $app_process = array("취소","접수","신청확인","진행중","심사중","","","","","완료");

    return Datatables::of($appsupdateData)
            ->setRowId(function($appsupdateData) {
              return $appsupdateData->idx;
            })
            ->editColumn('update_process', function($eloquent) use ($app_process){
              return $app_process[$eloquent->update_process];
            })
            // ->editColumn('pm_used', function($eloquent) {
            //   if ($eloquent->pm_used == 0) return "미사용";
            //   else return "사용 ".date('Y-m-d', $eloquent->used_time);
            // })
            // ->editColumn('pm_target', function($eloquent) {
            //   if ($eloquent->pm_target == "ma") return "마케팅 오토메이션";
            //   else return "앱 서비스";
            // })
            // ->editColumn('pm_content', function($eloquent) {
            //   $preData = explode(":", $eloquent->pm_content);
            //   return "월 ".number_format($preData[0])."원 지정결제";
            // })
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
