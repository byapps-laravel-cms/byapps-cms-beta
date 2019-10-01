<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\HomeLayout;
use App\AppsData;

use App\Http\Controllers\ExpiredController;


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

        $preData = new ExpiredController;
        $expiredIos = $preData->getExpiredIos();

        return view('home')->with(array('home_layouts' => $layouts,
                                          'expiredIos' => $expiredIos));

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
