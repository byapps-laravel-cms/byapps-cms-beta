<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MAData;
use App\AppsData;
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

              $remain_day = ($eloquent->end_time->timestamp - time()) / 86400;
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
              $remain_day = floor(($eloquent->end_time->timestamp - time()) / 86400);
              if (!$eloquent->end_time) {
                $remain_day = "무제한";
              }

              if ($eloquent->start_time && $eloquent->end_time) {
                return $eloquent->start_time->format('Y-m-d')." ~ ".$eloquent->start_time->format('Y-m-d')." (".$remain_day.")";
              } else {
                return "미지정";
              }
            })
            ->editColumn('reg_time', function($eloquent) {
                return $eloquent->reg_time->format('Y-m-d');
            })
            // ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $data['maData'] = MAData::find($idx);
    if(!$data['maData']) abort(400);
    $data['maData']->toArray();
    $data['appLang'] = explode('|',$data['maData']->app_lang);
    return view('madetail')->with($data);
  }
  public function update($idx){
    if(request()->has('mode') && request()->input('mode') == 'get_info'){
        $appId = MAData::find($idx,'ma_id')->ma_id;
        $data = AppsData::where('app_id','=',$appId)->first(['app_android_url','app_ios_url','surl']);
        $result['pn'] = substr($data['app_android_url'],45);
        $result['schm'] = $appId;
        if($data->app_ios_url)
            $result['aid'] = get_string_between($data->app_ios_url,'/id','?');
        if($data->surl)
            $result['surl'] = $data->surl;
        return $result;
    }
    $data = request()->only(['app_process','ma_ver','auto_push','service_ma','service_type','start_time','end_time','start_time','pn','aid','schm','push_center','txtencode','host_name','app_lang','opt_sst','vip_check','info']);

    $data['app_lang'] = join($data['app_lang'],'|');
    if($data['app_process'] > 10 || $data['app_process'] < 0)return validateExit(['col'=>'app_process','message'=>'process 입력이 잘못됨']);
    //app_os 둘다 체크시 both 로 변경
    if(!isset($data['service_type']) || count($data['service_type']) == 0)return validateExit(['col'=>'service_type','message'=>'OS를 하나이상 선택 하세요.']);
    $data['service_type'] = count($data['service_type']) > 1 ? 'both' : $data['service_type'][0];
    if(!preg_match('/^20\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[0-1])$/',$data['start_time']) && $data['start_time'] != '')return validateExit(['col'=>'start_time','message'=>'서비스 시작일이 날짜형식이 아님']);
    if(!preg_match('/^20\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[0-1])$/',$data['end_time']) && $data['end_time'] != '')return validateExit(['col'=>'end_time','message'=>'서비스 시작일이 날짜형식이 아님']);

    MAData::find($idx)->update($data);

    return request()->ajax() ? response()->json(['success' => 'true',], 200) : $this->getSingleData($idx);
  }
}
