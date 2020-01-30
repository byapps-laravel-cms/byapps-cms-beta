<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\User;
use App\HomeLayout;
use App\AppsData;
use App\AppsOrderData;
use App\AppsPaymentData;
use App\PromotionData;
use App\UserInfo;

use App\Http\Controllers\ChartController;
use App\Http\Controllers\SalesChartController;
use App\Http\Controllers\ExpiredController;
use App\Http\Controllers\StatusController;

use Spatie\Searchable\Search;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // 홈 레이아웃
        $userId = $request->user()->idx;
        $layout = HomeLayout::where('user_cd','=', $userId)
                              ->select('layout_name')
                              ->orderBy('sequence')
                              ->get();

        if (count($layout) == 0){
          $layouts = array('layout1', 'layout2', 'layout3', 'layout4', 'layout5');
        } else {
          $layouts = array();

          foreach($layout as $record){
              $temp[] = $record->layout_name;
          }

          $layouts = $temp;
        }

        // 주문요청현황 데이터
        $preData = new StatusController;
        // 임시날짜로 테스트
        $appsOrderCount = $preData->onGetAppsOrderCount('2020-01-01');
        $appendixOrderCount = $preData->onGetAppendixOrderCount('2020-01-01');
        $updateCount = $preData->onGetUpdateCount('2020-01-01');
        $MACount = $preData->onGetMACount('2020-01-01');


        // 만료예정 데이터
        $preData = new ExpiredController;
        $expiredIos = $preData->getExpiredIos();
		    $expiredIosTotCnt = $preData->getExpiredIosTotCnt();
        $willBeExpiredIos = $preData->getWillBeExpiredIos();
        $expiredPush = $preData->getExpiredPush();
        $willBeExpiredPush = $preData->getWillBeExpiredPush();
        $expiredMA = $preData->getExpiredMA();
        $willBeExpiredMA = $preData->getWillBeExpiredMA();
        $expiredApps = $preData->getExpiredApps();
        $willBeExpiredApps = $preData->getWillBeExpiredApps();

        // 차트데이터
        $preData = new ChartController;
        $chartData = $preData->index();

        // 매출차트데이터
        $preData = new SalesChartController;
        $salesChartData = $preData->index();

        return view('home')->with(array('home_layouts' => $layouts,
                                        'appsOrderCount' => $appsOrderCount,
                                        'appendixOrderCount' => $appendixOrderCount,
                                        'updateCount' => $updateCount,
                                        'maCount' => $MACount,
                                        'expiredIos' => $expiredIos,
										                    'expiredIosTotCnt' => $expiredIosTotCnt,
                                        'willBeExpiredIos' => $willBeExpiredIos,
                                        'expiredPush' => $expiredPush,
                                        'willBeExpiredPush' => $willBeExpiredPush,
                                        'expiredMA' => $expiredMA,
                                        'willBeExpiredMA' => $willBeExpiredMA,
                                        'expiredApps' => $expiredApps,
                                        'willBeExpiredApps' => $willBeExpiredApps,
                                        'chartData' => $chartData,
                                        'salesChartData' => $salesChartData,
                                        )
                                  );
    }

    public function onLayoutChange(Request $request)
    {
        $userId = $request->user()->idx;
        $params = $request->all();
        $temp = HomeLayout::where('user_cd','=', $userId)
                            ->count();

        foreach($params as $key => $value){
            unset($data);
            $data['sequence'] = $value;
            if ($temp == 0){
                $data['layout_name'] = $key;
                $data['user_cd'] = $userId;
                HomeLayout::insert($data);
            } else {
                HomeLayout::where('user_cd','=', $userId)
                          ->where('layout_name','=', $key)
                          ->update($data);
            }
        }
    }

    public function search(Request $request)
    {
      if(!$request->has('query')) abort(400);

      if($request->ajax()) return (new Search())
                        ->registerModel(AppsData::class, 'app_name')
                        ->search($request->input('query'));

      $searchResults = (new Search())
                       ->registerModel(AppsPaymentData::class, 'app_name')
                       ->registerModel(PromotionData::class, 'mem_name')
                       ->registerModel(AppsOrderData::class, 'app_company')
                       ->registerModel(UserInfo::class, 'mem_name')
                        ->search($request->input('query'));

      $typesArray = [ 'BYAPPS_apps_payment_data' => '결제 관리',
                      'BYAPPS2016_promotion_data' => '프로모션',
                      'BYAPPS_apps_order_data' => '앱 접수',
                      'BYAPPS_user_info' => '고객 정보',
                    ];

      return view('search', compact('searchResults', 'typesArray'));
    }

}
