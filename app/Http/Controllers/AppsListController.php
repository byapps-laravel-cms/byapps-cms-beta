<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

use App\AppsData;
use App\AppsStat;
use App\AppsSaleStat;

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

      //설치 통계
      $downs = $data['appData']->downs->toArray();
      $downs['time'] = $now->diffInDays(Carbon::createFromFormat('Y-m-d H:i:s',$downs['reg_date']));
      $downs['average'] = round($downs['total_c']/$downs['time']);

      $data['downData'] = $downs;

      //이용 통계
      $uses = AppsStat::where('app_id','=',$data['appData']->app_id)->first(['total_c','today_c','yesterday_c','max_c','reg_date','launch_date']);
      $uses->toArray();

      $uses['time'] = $now->diffInDays(Carbon::createFromFormat('Y-m-d H:i:s',$uses['reg_date']));
      $uses['average'] = round($uses['total_c']/$uses['time']);

      $data['useData'] = $uses;

      //매출 통계
      $sales = AppsSaleStat::where('app_id','=',$data['appData']->app_id)->first(['total_c','today_c','yesterday_c','max_c','total_m','today_m','yesterday_m','max_m','max_c_date','reg_date','launch_date']);
      if($sales == null) $sales = [];
      else {
          $sales->toArray();

          $sales['time'] = $now->diffInDays(Carbon::createFromFormat('Y-m-d H:i:s',$sales['reg_date']));
          $sales['average_c'] = round($sales['total_c']/$uses['time']);
          $sales['average_m'] = round($sales['total_m']/$uses['time']);
      }

      $data['saleData'] = $sales;

      return view('appsdetail')->with($data);
    }

    public function update($idx)
    {
        $data = request()->only(['app_process','service_type','app_os_type','byapps_ver','app_ver','app_build','app_ver_ios','app_build_ios','app_cate','noti_gcm','noti_gcm_num','noti_fcm_num','noti_ios_cerp','ios_cer_exp','ios_dev_exp','push_server','token','start_time','end_time','app_android_url','app_ios_url','surl','vender','hashkey','ioshack','host_id','txtencode','host_name','app_lang','auto_login','login_point','push_point','install_point','point_transfer_btn','cscall','app_intro','developer_info','start_date','end_time']);
        $data['developer_info'] = XSS($data['developer_info']);
        $data['app_lang'] = join($data['app_lang'],'|');
        //카테고리 01~07사이
        if(!preg_match('/^0[1-7]$/',$data['app_cate']))return validateExit(['col'=>'app_cate','message'=>'카테고리 입력이 잘못됨']);
        if($data['app_process'] > 10 || $data['app_process'] < 0)return validateExit(['col'=>'app_process','message'=>'process 입력이 잘못됨']);
        //날짜 형식
        if(!preg_match('/^20\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[0-1])$/',$data['ios_cer_exp']) && $data['ios_cer_exp'] != '')return validateExit(['col'=>'ios_cer_exp','message'=>'인증서 만료일이 날짜형식이 아님']);
        if(!preg_match('/^20\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[0-1])$/',$data['ios_dev_exp']) && $data['ios_dev_exp'] != '')return validateExit(['col'=>'ios_dev_exp','message'=>'개발자 만료일이 날짜형식이 아님']);
        if(!preg_match('/^20\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[0-1])$/',$data['start_time']))return validateExit(['col'=>'start_time','message'=>'플랫폼 시작일이 날짜형식이 아님']);
        if(!preg_match('/^20\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[0-1])$/',$data['end_time']))return validateExit(['col'=>'end_time','message'=>'플랫폼 종료일이 날짜형식이 아님']);
        //Y or N
        if(!isset($data['auto_login']))$data['auto_login'] = 'N';
        elseif($data['auto_login'] != 'Y')return validateExit(['col'=>'auto_login','message'=>'자동로그인 입력이 잘못됨']);
        if(!isset($data['login_point']))$data['login_point'] = 'N';
        elseif($data['login_point'] != 'Y')return validateExit(['col'=>'login_point','message'=>'출석체크 포인트 입력이 잘못됨']);
        if(!isset($data['push_point']))$data['push_point'] = 'N';
        elseif($data['push_point'] != 'Y')return validateExit(['col'=>'push_point','message'=>'푸쉬체크 포인트 입력이 잘못됨']);
        if(!isset($data['install_point']))$data['install_point'] = 'N';
        elseif($data['install_point'] != 'Y')return validateExit(['col'=>'install_point','message'=>'앱설치 포인트 입력이 잘못됨']);
        if(!isset($data['point_transfer_btn']))$data['point_transfer_btn'] = 'N';
        elseif($data['point_transfer_btn'] != 'Y')return validateExit(['col'=>'point_transfer_btn','message'=>'앱 포인트,수동전환 입력이 잘못됨']);
        //app_os 둘다 체크시 both 로 변경
        if(!isset($data['app_os_type']) || count($data['app_os_type']) == 0)return validateExit(['col'=>'app_os_type','message'=>'OS를 하나이상 선택 하세요.']);
        $data['app_os_type'] = count($data['app_os_type']) > 1 ? 'both' : $data['app_os_type'][0];

        $data['modify_time'] = time();

        AppsData::find($idx)->update($data);

        return request()->ajax() ? response()->json(['success' => 'true',], 200) : $this->getSingleData($idx);
    }
}
