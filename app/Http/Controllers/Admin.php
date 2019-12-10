<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Admin;

class Admin extends Controller
{
    public function update($idx){
        $data = Admin::find($idx);
        if(!$data) abort(404);
        if(request()->has('permission')) abort(400);
        $permission = request()->input('permission');
        if(is_array($permission)) $permission = join('|',$permission);
        $permission = '|'.$permission.'|';
        $data->update(['adminNMNew'=>$permission]);
        return request()->ajax() ? response()->json($res, 400) : '';
    }
}
