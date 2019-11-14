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
                                 'recom_id',
                                 'app_name',
                                 'ma_ver',
                                 'service_type',
                                 'server_group',
                                 'app_process',
                                 'web_push',
                                 'auto_push',
                                 'start_time',
                                 'end_time',
                                 'reg_time');

    $app_process = array("","SDK설치중","등록대기","등록완료","서비스중지","기간만료","서비스유효");

    return Datatables::of($maListData)
            ->setRowId(function($maListData) {
                return $maListData->idx;
            })
            ->editColumn('service_type', function($eloquent) {
              $value = '';
              if ($eloquent->service_type == 'both') {
                $value = "리타겟/MA";
              } else if ($eloquent->service_type == 'retarget') {
                $value = "리타겟";
              } else if ($eloquent->service_type == 'ma') {
                $value = "MA";
              }

              if ($eloquent->web_push == 'Y') {
                $value = $value."/웹푸쉬";
              }

              if ($eloquent->auto_push == 'Y') {
                $value = $value."/푸쉬자동화";
              }

              return $value;
            })
            ->editColumn('server_group', function($eloquent) {
              return $eloquent->server_group." 그룹";
            })
            ->editColumn('app_process', function($eloquent) use ($app_process) {
              $status = '';
              $status = $app_process[$eloquent->app_process];

              $remain_day = ($eloquent->end_time - time()) / 86400;
              if ($eloquent->app_process == 3 && ($eloquent->end_time && $remain_day < 0)) {
                $status = "만료";
              }

              return $status;
            })
            ->editColumn('ma_id', function($eloquent) {
              if ($eloquent->recom_id != 'byapps') {
                return $eloquent->ma_id."(".$eloquent->recom_id.")";
              } else {
                return $eloquent->ma_id;
              }
            })
            ->editColumn('service_term', function($eloquent) {
              $remain_day = floor(($eloquent->end_time - time()) / 86400);
              if (!$eloquent->end_time) {
                $remain_day = "무제한";
              }

              if ($eloquent->start_time && $eloquent->end_time) {
                return date("Y-m-d", $eloquent->start_time)." ~ ".date("Y-m-d", $eloquent->end_time)." (".$remain_day.")";
              } else {
                return "미지정";
              }
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
