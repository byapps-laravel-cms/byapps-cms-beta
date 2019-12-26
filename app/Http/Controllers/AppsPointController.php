<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppsPointData;
use App\AppsPointMemberData;
use Yajra\Datatables\Datatables;
use DB;

class AppsPointController extends Controller
{
  public function getIndex()
  {
      return view('appspointlist');
  }

  public function getAppsPointListData()
  {
    $appspointlistData = AppsPointData::select('idx',
                                             'app_id',
                                             'app_name',
                                             'mem_id',
                                             'point',
                                             'point_title',
                                             'reg_time');

    return Datatables::of($appspointlistData)
            ->setRowId(function($appspointlistData) {
                return $appspointlistData->idx;
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            // ->orderColumn('reg_time', 'reg_time $1')
            // ->orderColumn('idx')
            ->make(true);
  }

  public function getSingleData($idx)
  {	
	//앱 포인트 테이블
    $appsPointData = AppsPointData::where('idx', $idx)->first();
	
	//앱 포인트 테이블의 앱 하나의 포인트 총합
	$chk = AppsPointData::where('app_id', $appsPointData->app_id)->where('mem_id', $appsPointData->mem_id)->where('mem_type', $appsPointData->mem_type)->where('pay_back', '0')->where('point_type', '!=', '0')->value(DB::raw('sum(point)'));
	
	if(!$chk) $chk = 0;

	//앱 회원 포인트 테이블
	$appsPointMemberData = AppsPointMemberData::where('app_id', $appsPointData->app_id)->where('mem_id', $appsPointData->mem_id)->where('mem_type', $appsPointData->mem_type)->first();
	
	$btn_act='<input type="button" class="btn btn-info mx-auto" value="교환 수동신청" onclick="this.form.submit()" class="nbutton"> ';

	$err=($appsPointMemberData->total_point != $chk) ? "적립 포인트 불일치" : "N/A";

	$valu = [
		'idx' => $appsPointMemberData->idx,
		'app_id' => $appsPointMemberData->app_id,
		'mem_id' => $appsPointMemberData->mem_id,
		'app_udid' => $appsPointMemberData->app_udid,
		'app_name' => $appsPointMemberData->app_name,
		'app_os' => $appsPointMemberData->app_os,
		'app_ver' => $appsPointMemberData->app_ver,
		'app_lang' => $appsPointMemberData->app_lang,
		'total_point' => number_format($appsPointMemberData->total_point),
		'chk' => number_format($chk),
		'total_payback_point' => number_format($appsPointMemberData->total_payback_point),
		'err' => $err,
		'btn_act' => $btn_act,
		'point_id' => $appsPointData->point_id,
		'point_title' => $appsPointData->point_title,
		'msg' => ($appsPointData->pay_back != '1') ? '적립됨' : '교환처리됨',
		'point' => $appsPointData->point,
		'reg_time' => date("Y-m-d H:i:s", $appsPointData->reg_time),
	];

	return view('appspointdetail')->with('valu', $valu);
  }
}
