<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle($request, Closure $next, $guard = null)
    {
        $pageName = str_replace('.view','',\Request::route()->getName());
        try {
            $per = request()->user()->adminNMNew;
        } catch (\Exception $e) {
            return request()->ajax() ? response()->json(['message' => '권한이 없습니다.'], 400) : redirect(route('login'));
        }

        if (Auth::guard($guard)->check()) {
            if($per == 'all' || url()->current() == config('app.url') || strpos($per,'|'.$pageName.'|') > -1)
                return $next($request);
        }
        return request()->ajax() ? response()->json(['message' => '권한이 없습니다.'], 400) : redirect('/');
    }
}
