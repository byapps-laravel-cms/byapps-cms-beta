<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UpdateData;
use Yajra\Datatables\Datatables;

class UpdateController extends Controller
{
  public function getIndex()
  {
      return view('updatelist');
  }

  public function getUpdateData()
  {
    $updateData = UpdateData::select('idx',
                                    'reg_time',
                                    'update_process',
                                    'app_id',
                                    'app_name',
                                    'os',
                                    'update_type',
                                    'update_ver'
                                    );

    return Datatables::of($updateData)
            ->setRowId(function($updateData) {
              return $updateData->idx;
            })
            // ->editColumn('mem_name', function($eloquent) {
            //   return $eloquent->mem_name."(".$eloquent->mem_id.")";
            // })
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
    $updateData = UpdateData::where('idx', $idx)->first();

    return view('updatedetail')->with('updateData', $updateData);
  }

}
