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

        return view('home')->with('home_layouts', HomeLayout::where('user_cd','=',$userId)
                                                  ->select('layout_name')
                                                  ->orderBy('sequence')
                                                  ->get());
    }
}
