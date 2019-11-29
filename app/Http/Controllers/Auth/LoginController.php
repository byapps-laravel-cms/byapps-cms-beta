<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Admin as User;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

     protected function guard()
 	{
 		return \Illuminate\Support\Facades\Auth::guard('web');
 	}

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
	{
        $user = User::where('mem_id','=',request()->input('user_id'));
        if($user->count() == 0)return response()->json(['success' => false,'message' => 'user_id'], 200);
        $idx = $user->where('passwd','=',DB::raw('password(\'' . request()->input('password') . '\')'))->max('idx');
        if(is_null($idx))return response()->json(['success' => false,'message' => 'password'], 200);
        User::find($idx)->update(['log_time' => 'now']);
        $this->guard()->loginUsingId($idx);
        return response()->json(['success' => 'true'], 200);
    }
}
