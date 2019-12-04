<?php

namespace App\Http\Controllers\Auth;

//use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use \Illuminate\Support\Facades\Auth;

use App\Admin as User;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mem_id' => ['required', 'string', 'max:255', 'unique:users'],
            'mem_name' => ['required', 'string', 'max:255'],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'passwd' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register()
    {
        $data = request()->all();

        Auth::guard('web')->loginUsingId(
          User::insertGetId([
            'mem_id' => $data['user_id'],
            'mem_name' => $data['name'],
            //'email' => $data['email'],
            //'password' => Hash::make($data['password']),
            'passwd' => DB::raw('password(\'' . $data['password'] . '\')'),
            'reg_date' => \Carbon\Carbon::now()->toDateTimeString(),
            'adminMN' => '-free_order-',
            'guestMN' => 'Y'
          ])
        );

        return redirect($this->redirectPath())->with('message', '등록되었습니다');
    }

    protected function registered(Request $request, $user)
    {
      // 세션 생성
      Auth::attempt([
        'user_id' => $request->input('user_id'),
        'name' => $request->input('name'),
        //'password' => $request->input('password')
      ]);

      return response(null, 204);
    }

}
