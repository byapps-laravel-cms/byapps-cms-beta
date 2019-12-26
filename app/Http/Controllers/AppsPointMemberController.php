<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppsPointMemberData;
use App\AppsPushData;
use Yajra\Datatables\Datatables;

class AppsPointMemberController extends Controller
{
  public function getIndex()
  {
      return view('appspointmemberlist');
  }

  public function getAppsPointMemberListData()
  {
    $appspointmemberlistData = AppsPointMemberData::select('idx',
                                           'app_id',
                                           'app_name',
                                           'mem_id',
                                           'total_point',
                                           'app_os',
                                           'app_ver',
                                           'reg_time');

    return Datatables::of($appspointmemberlistData)
            ->setRowId(function($appspointmemberlistData) {
                return $appspointmemberlistData->idx;
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
	// 앱 회원 포인트 테이블
    $appsPointMemberData = AppsPointMemberData::where('idx', $idx)->first();
	
	// 앱 푸시 데이터 테이블
	$appsPushData = AppsPushData::where('app_id', $appsPointMemberData->app_id)->where('app_udid', $appsPointMemberData->app_udid)->first();
	
	$valu = [
		'app_name' => $appsPointMemberData->app_name,
		'app_id' => $appsPointMemberData->app_id,
		'mem_id' => $appsPointMemberData->mem_id,
		'app_lang' => "",
		'app_os' => "",
		'app_ver' => "",
		'app_udid' => "",
		'device_name' => "",
		'device_ver' => "",
		'push_agree' => "",
		'reg_time' => "",
		'visit_cnt' => "",
		'last_time' => "",
		'order_cnt' => "",
		'order_amount' => "",
		'last_purchase_time' => "N",
		'total_point' => "0",
		'total_payback_point' => "0",
	];
	
	if($appsPushData != "") {
		$valu['app_lang'] = $appsPushData->app_lang;
		$valu['app_os'] = $appsPushData->app_os;
		$valu['app_ver'] = $appsPushData->app_ver;
		$valu['app_udid'] = $appsPushData->app_udid;
		$valu['device_name'] = $appsPushData->device_name;
		$valu['device_ver'] = $appsPushData->device_ver;
		$valu['push_agree'] = $appsPushData->push_agree;
		$valu['reg_time'] = date("Y/m/d [H:i:s]", $appsPushData->reg_time);
		$valu['visit_cnt'] = number_format($appsPushData->visit_cnt);
		$valu['last_time'] = $appsPushData->last_time ? date("Y/m/d [H:i:s]", $appsPushData->last_time) : date("Y/m/d [H:i:s]", $appsPushData->reg_time);
		$valu['order_cnt'] = number_format($appsPushData->order_cnt);
		$valu['order_amount'] = number_format($appsPushData->order_amount);
		$valu['last_purchase_time'] = $appsPushData->last_purchase_time ? date("Y/m/d [H:i:s]", $appsPushData->last_purchase_time) : 'N';
	}

    return view('appspointmemberdetail')->with('valu', $valu);
  }
}
