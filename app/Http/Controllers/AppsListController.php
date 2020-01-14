<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use Yajra\Datatables\Datatables;
use Carbon\Carbon;

use App\PushSchedule;
use App\Comment;
use App\AppsData;
use App\AppsStat;
use App\AppsSaleStat;

class AppsListController extends Controller
{
    protected $columns;
    public function __construct(){
        $this->columns = [
            'app_process' => 'Process',
            'end_time' => '플랫폼 종료 시간',
            'retarget_end' => '리타겟팅 종료 시간',
            'service_type' => 'service type',
            'login_point' => '출석체크 서비스',
            'auto_login' => '자동로그인 설정',
            'push_point' => '푸쉬체크 서비스',
            'install_point' => '앱설치포인트 서비스',
            'lock_screen' => '잠금화면 서비스',
            'app_cart' => '장바구니 리마인드 서비스',
            'app_retarget' => '장바구니 리마인드 서비스',
            'app_ma' => '마케팅오토메이션 서비스',
            'app_members' => '앱사용자 관리',
            'reward_opt' => '리워드 서비스',
            'push_server' => '푸쉬서버',
            'developer_info' => '앱정보',
            'app_intro' => '앱소개',
            'start_time' => '시작시간',
        ];
    }

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
      $data['appData'] = AppsData::find($idx);
      if($data['appData'] == null) abort(404);

      $data['sendMode'] = 'apps';

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
      $data['mem_id'] = $data['appData']->mem_id;

      return view('appsdetail')->with($data);
    }

    protected function validator(array $data)
    {
       return Validator::make($data, [
           'app_process' => ['required', 'integer',Rule::in([1,2,3,4,5,6,7,8,10])],
           'service_type' => ['required','string',Rule::in(['biz','lite','tester'])],
           'app_os_type' => ['required','array'],
           'byapps_ver' => ['required'],
           'app_ver' => '',
           'app_build' => '',
           'app_ver_ios' => '',
           'app_build_ios' => '',
           'app_cate' => ['required',Rule::in(['01','02','03','04','05','06','07'])],
           'noti_gcm' => '',
           'noti_gcm_num' => '',
           'noti_fcm_num' => '',
           'noti_ios_cerp' => '',
           'ios_cer_exp' => ['date_format:Y-m-d'],
           'ios_dev_exp' => ['date_format:Y-m-d'],
           'push_server' => ['required',Rule::in([
                   'default',
                   'http://byappspush4.cafe24app.com/',
                   'http://byappspush3.cafe24app.com/',
                   'http://byapps.cafe24app.com/',
                   'http://byappspush2.cafe24app.com/',
                   'http://push1.cafe24app.com/',
               ])
           ],
           'token' => '',
           'start_time' => ['required','date_format:Y-m-d'],
           'end_time' => ['required','date_format:Y-m-d','after:start_time'],
           'app_android_url' => '',
           'app_ios_url' => '',
           'surl' => '',
           'androi_pk' => '',
           'bundleid' => '',
           'vender' => '',
           'hashkey' => '',
           'android_hash' => '',
           'host_id' => '',
           'txtencode' => ['required',Rule::in(['utf-8','euc-kr'])],
           'host_name' => ['required',Rule::in(['cafe24','makeshop','etc','godo','wisa'])],
           'app_lang' => ['required','array'],
           'cscall' => ['required','regex:/^\d{2,3}-\d{3,4}-\d{4}$/'],
           'receipt' => '',
           'app_intro' => '',
           'developer_info' => '',
           'auto_login' => ['required',Rule::in('Y','N')],
           'login_point' => ['required',Rule::in('Y','N')],
           'push_point' => ['required',Rule::in('Y','N')],
           'install_point' => ['required',Rule::in('Y','N')],
           'point_transfer_btn' => ['required',Rule::in('Y','N')],

       ],[

       ]);
    }

    public function update($idx)
    {
        if(AppsData::where('idx','=',$idx)->count() == 0) abort(404);
        $model = AppsData::find($idx);
        $data = request()->only(['app_process','service_type','app_os_type','byapps_ver','app_ver','app_build','app_ver_ios','app_build_ios','app_cate','noti_gcm','noti_gcm_num','noti_fcm_num','noti_ios_cerp','ios_cer_exp','ios_dev_exp','push_server','token','end_time','app_android_url','app_ios_url','surl','vender','hashkey','ioshack','host_id','txtencode','host_name','app_lang','auto_login','login_point','push_point','install_point','point_transfer_btn','cscall','app_intro','developer_info','end_time','start_time']);
        $data['developer_info'] = XSS($data['developer_info']);

        if(!isset($data['auto_login']))$data['auto_login'] = 'N';
        if(!isset($data['login_point']))$data['login_point'] = 'N';
        if(!isset($data['push_point']))$data['push_point'] = 'N';
        if(!isset($data['install_point']))$data['install_point'] = 'N';
        if(!isset($data['point_transfer_btn']))$data['point_transfer_btn'] = 'N';

        if($data['ios_cer_exp'] == null) unset($data['ios_cer_exp']);
        if($data['ios_dev_exp'] == null) unset($data['ios_dev_exp']);

        $this->validator($data)->validate();

        $data['app_lang'] = join($data['app_lang'],'|');

        //app_os 둘다 체크시 both 로 변경
        $data['app_os_type'] = count($data['app_os_type']) > 1 ? 'both' : $data['app_os_type'][0];

        $model->fill($data);

        $this->logging($model);

        //수정시간 변경
        $data['modify_time'] = time();

        $model->save();

        return request()->ajax() ? response()->json(['success' => 'true',], 200) : $this->getSingleData($idx);
    }
    public function logging($model){
        $data = [
            'mmid' => 'apps',
            'pidx' => request()->route()->parameter('idx'),
            'pmid' => $model->mem_id,
            'mem_id' => request()->user()->mem_id,
            'reg_time' => time(),
            'mem_name' => request()->user()->mem_name
        ];
        $app_process = array("","개발준비중","개발진행중","심사중","등록거부","재심사중","등록대기","등록완료","서비스중지","기간만료","서비스유효");
        $comment = new Comment();
        foreach($model->getAttributes() as $col => $new){
            $old = $model->getOriginal($col);
            $temp[$old] = $new;
            if($old != $new){
                $data['comment'] = $this->columns[$col] . ' ';
                switch ($col) {
                    case 'app_process':
                        $data['comment'].= $app_process[$old]." → ".$app_process[$new];
                        if($new == '8') {
                            $pushSc = PushSchedule::where('app_id','=',$model->getOriginal('app_id'));
                            if($pushSc->value('idx')){
                                $pushSc->delete();
                                $comment->insert($data);
                                $data['comment'] = '서비스중지로 푸쉬스케쥴링 삭제처리됨';
                            }
                        }
                        break;
                    case 'end_time':
                    case 'start_time':
                    case 'retarget_end':
                        $data['comment'].= ($old ? date("Y-m-d",$old) : "미정")." → ".date("Y-m-d",$new);
                        break;
                    case 'service_type':
                        $temp = [
                            'lite' => '라이트',
                            'tester' => '테스터',
                            'biz' => '일반'
                        ];
                        $data['comment'].= $temp[$old] . ' → ' . $temp[$new];
                        break;
                    case 'login_point':
                    case 'auto_login':
                    case 'push_point':
                    case 'install_point':
                    case 'lock_screen':
                    case 'app_cart':
                    case 'app_retarget':
                    case 'app_ma':
                    case 'app_members':
                    case 'reward_opt':
                        $data['comment'].= ($old == 'Y' ? '허용' : '미허용'). ' → ' . ($new == 'Y' ? '허용' : '미허용');
                        break;
                    case 'push_server':
                        $data['comment'].= $old." → ".$new;
                        break;
                    default:
                       // code...
                        break;
               }
               $data['comment'].= ' 변경';
               $comment->insert($data);
            }
        }
    }
}
