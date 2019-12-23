<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use Yajra\Datatables\Datatables;

use App\MAData;
use App\AppsData;

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

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'app_process' => ['required','integer',Rule::in(1,2,3,4,5,6)],
            'ma_ver'=> ['required'],
            'auto_push'=> ['required',Rule::in('Y','N')],
            // 'service_ma'=> ['required',Rule::in('Y','N')],
            'service_type'=> ['required',Rule::in('both','tararget','ma')],
            'start_time' => ['required','date_format:Y-m-d'],
            'end_time' => ['required','date_format:Y-m-d','after:start_time'],
            'pn'=> ['required'],
            'aid'=> '',
            'schm'=> ['required'],
            'push_center'=> '',
            'txtencode'=> ['required',Rule::in(['utf-8','euc-kr'])],
            'host_name'=> ['required',Rule::in(['cafe24','makeshop','etc','godo'])],
            'app_lang'=> ['required','array'],
            'opt_sst'=> ['required',Rule::in('Y','N')],
            'vip_check'=> '',
            'info' => ''
        ]);
    }
    public function getSingleData($idx)
    {
        $data['maData'] = MAData::find($idx);
        if($data['maData'] == null) abort(400);
        $data['maData']->toArray();
        $data['appLang'] = explode('|',$data['maData']->app_lang);
        return view('madetail')->with($data);
    }
    public function update($idx){
        //앱설치 정보
        if(request()->has('mode') && request()->input('mode') == 'get_info'){
            $appId = MAData::find($idx,'ma_id')->ma_id;
            $data = AppsData::where('app_id','=',$appId)->first(['app_android_url','app_ios_url','surl']);
            $result['pn'] = substr($data['app_android_url'],45);
            $result['schm'] = $appId;
            if($data->app_ios_url)
                $result['aid'] = get_string_between($data->app_ios_url,'/id','?');
            if($data->surl)
                $result['home_url'] = $data->surl;
            return $result;
        }
        $maData = MAData::find($idx);
        if($maData == null) abort(404);
        $data = request()->only(['app_process','ma_ver','auto_push','service_ma','service_type','start_time','end_time','pn','aid','schm','push_center','txtencode','host_name','app_lang','opt_sst','vip_check','info']);

        if(!isset($data['auto_push']))$data['auto_push'] = 'N';
        // if(!isset($data['service_ma']))$data['service_ma'] = 'N';

        $data['service_type'] = count($data['service_type']) > 1 ? 'both' : $data['service_type'][0];

        $this->validator($data)->validate();

        $data['app_lang'] = join($data['app_lang'],'|');

        $maData->update($data);

        return request()->ajax() ? response()->json(['success' => 'true',], 200) : back();
    }
}
