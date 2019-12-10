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
        try {
            $data = $user->first(['idx','err']);
            $idx = $data->idx;
            if($data->err >= 5) return response()->json(['success' => false,'message' => '5번 틀렸습니다.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false,'message' => 'user_id'], 200);
        }
        try {
            $idx = $user->where('passwd','=',DB::raw('password(\'' . request()->input('password') . '\')'))->first('idx')->idx;
        } catch (\Exception $e) {
            User::find($idx)->increment('err');
            return response()->json(['success' => false,'message' => 'password'], 200);
        }
        User::where('mem_id','=',request()->input('user_id'))->update(['log_time' => 'now','err' => 0]);
        $this->guard()->loginUsingId($idx);
        //로그인 정보 기억
        if(request()->has('remember') && request()->input('remember') == 'on'){
            \Cookie::queue(\Cookie::make('login_remember',request()->input('user_id'), 60*24*365));
        }else{
            \Cookie::queue(\Cookie::forget('login_remember'));
        }
        return response()->json(['success' => 'true'], 200);
    }
}
