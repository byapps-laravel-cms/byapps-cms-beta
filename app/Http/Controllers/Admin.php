<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Admin as Data;

class Admin extends Controller
{
    public function update($idx){
        $data = Data::find($idx);
        if(!$data) abort(404);
        if(request()->has('permission')) abort(400);
        $permission = request()->input('permission');
        if($permission != 'all'){
            if(is_array($permission)) $permission = join('|',$permission);
            $permission = '|'.$permission.'|';
        }
        $data->update(['adminNMNew' => $permission]);
        return request()->ajax() ? response()->json(['success' => true], 200) : '';
    }
    public function detail($idx){
        $routeData = \Route::getRoutes();
        foreach ($routeData as $value) {
            $temp = [];
            $temp['middleware'] = $value->gatherMiddleware();
            $temp['action'] = $value->getActionName();
            $temp['name'] = $value->getName();
            $data[] = $temp;
        }
        dd($data);
    }
}
