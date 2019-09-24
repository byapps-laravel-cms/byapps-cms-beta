<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\HomeLayout;

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

        info (gettype($userId));

        $temp = HomeLayout::where('user_cd','=', $userId)
                                                  ->select('layout_name')
                                                  ->orderBy('sequence')
                                                  ->get();

        if (count($temp) == 0){
          $temp = array('layout1','layout2','layout3', 'layout4');
        }
        return view('home')->with('home_layouts', $temp);
    }
}
