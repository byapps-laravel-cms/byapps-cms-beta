<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppsData;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class AppsListController extends Controller
{
    public function getIndex()
    {
        return view('appslist');
    }

    public function getAppsListData()
    {
    $appslistData = AppsData::select('idx', 'app_id', 'app_ver', 'byapps_ver', 'app_process', 'app_name', 'server_group', 'apps_type', 'script_popup');

    return Datatables::of($appslistData)
            ->setRowId(function($appslistData) {
                return $appslistData->idx;
            })
            ->editColumn('app_process', function($eloquent) {
                switch($eloquent->app_process){
                    case 1: return "개발준비중";
                    case 2: return "개발진행중";
                    case 3: return "심사중";
                    case 4: return "등록거부";
                    case 5: return "재심사중";
                    case 6: return "등록대기";
                    case 7: return "등록완료";
                    case 8: return "서비스중지";
                    case 9: return "기간만료";
                    case 10: return "서비스유효";
                    default: return "";
                }
            })
            ->editColumn('server_group', function($eloquent) {
                return $eloquent->server_group."그룹";
            })
            ->make(true);
    }

    public function getSingleData($idx)
    {
      $this->colums[] = 'app_id';
      $data['appData'] = AppsData::find($idx);
      if($data['appData'] == null) abort(404);

      $data['appLang'] = explode('|',$data['appData']->app_lang);

      $now = Carbon::now();

      //이용 통계
      $downs = $data['appData']->downs->toArray();
      $downs['time'] = $now->diffInDays(Carbon::createFromFormat('Y-m-d H:i:s',$downs['reg_date']));
      $downs['average'] = round($downs['total_c']/$downs['time']);

      $data['downData'] = $downs;

      return view('appsdetail')->with($data);
    }

    public function update($idx)
    {
        $data = request()->only(['app_process','service_type','app_os_type','byapps_ver','app_ver','app_build','app_ver_ios','app_build_ios','app_cate','noti_gcm','noti_gcm_num','noti_fcm_num','noti_ios_cerp','ios_cer_exp','ios_dev_exp','push_server','token','start_time','end_time','app_android_url','app_ios_url','surl','vender','hashkey','ioshack','host_id','txtencode','host_name','app_lang','auto_login','login_point','push_point','install_point','point_transfer_btn','cscall','app_intro','developer_info','start_date','end_time']);
        $data['developer_info'] = $this->XSS($data['developer_info']);
        $data['app_lang'] = join($data['app_lang'],'|');
        //카테고리 01~07사이
        if(!preg_match('/^0[1-7]$/',$data['app_cate']))abort(400,'카테고리 입력이 잘못됨');
        //날짜 형식
        if(!preg_match('/^20\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[0-1])$/',$data['ios_cer_exp']))abort(400,'인증서 만료일이 날짜형식이 아님');
        if(!preg_match('/^20\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[0-1])$/',$data['ios_dev_exp']))abort(400,'개발자 만료일이 날짜형식이 아님');
        if(!preg_match('/^20\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[0-1])$/',$data['start_time']))abort(400,'플랫폼 시작일이 날짜형식이 아님');
        if(!preg_match('/^20\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[0-1])$/',$data['end_time']))abort(400,'플랫폼 종료일이 날짜형식이 아님');
        //Y or N
        if(!isset($data['auto_login']))$data['auto_login'] = 'N';
        elseif($data['auto_login'] != 'Y')abort(400,'자동로그인 입력이 잘못됨');
        if(!isset($data['login_point']))$data['login_point'] = 'N';
        elseif($data['login_point'] != 'Y')abort(400,'출석체크 포인트 입력이 잘못됨');
        if(!isset($data['push_point']))$data['push_point'] = 'N';
        elseif($data['push_point'] != 'Y')abort(400,'푸쉬체크 포인트 입력이 잘못됨');
        if(!isset($data['install_point']))$data['install_point'] = 'N';
        elseif($data['install_point'] != 'Y')abort(400,'앱설치 포인트 입력이 잘못됨');
        if(!isset($data['point_transfer_btn']))$data['point_transfer_btn'] = 'N';
        elseif($data['point_transfer_btn'] != 'Y')abort(400,'앱 포인트,수동전환 입력이 잘못됨');

        $data['modify_time'] = time();

        AppsData::find($idx)->update($data);

        return request()->ajax() ? response()->json(['success' => 'true',], 200) : $this->getSingleData($idx);
    }
}
