<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\HomeLayout;
use App\AppsData;

use App\Http\Controllers\ChartController;
use App\Http\Controllers\ExpiredController;
use App\Http\Controllers\StatusController;

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
    public function index()
    {
        // 홈 레이아웃
        $userId = User::select('user_id')->get();
        $layouts = HomeLayout::where('user_cd','=', $userId)
                              ->select('layout_name')
                              ->orderBy('sequence')
                              ->get();

        if (count($layouts) == 0){
          $layouts = array('layout1', 'layout2', 'layout3', 'layout4');
        } else {
          $layouts = array();
          foreach($records as $record){
              $temp[] = $record->layout_name;
          }
          $layouts = $temp;
        }

        // 주문요청현황 데이터
        $preData = new StatusController;
        $appsOrderCount = $preData->onGetAppsOrderCount();
        $appendixOrderCount = $preData->onGetAppendixOrderCount();
        $updateCount = $preData->onGetUpdateCount();

        // 만료예정 데이터
        $preData = new ExpiredController;
        $expiredIos = $preData->getExpiredIos();
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

        return view('home')->with(array('home_layouts' => $layouts,
                                        'appsOrderCount' => $appsOrderCount,
                                        'appendixOrderCount' => $appendixOrderCount,
                                        'updateCount' => $updateCount,
                                        'expiredIos' => $expiredIos,
                                        'willBeExpiredIos' => $willBeExpiredIos,
                                        'expiredPush' => $expiredPush,
                                        'willBeExpiredPush' => $willBeExpiredPush,
                                        'expiredMA' => $expiredMA,
                                        'willBeExpiredMA' => $willBeExpiredMA,
                                        'expiredApps' => $expiredApps,
                                        'willBeExpiredApps' => $willBeExpiredApps,
                                        'chartData' => $chartData
                                        )
                                  );
    }

    public function onLayoutChange()
    {
        $userId = User::select('user_id')->get();
        $params = Input::all();
        $temp = HomeLayout::where('user_cd','=',$userId)
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

}
