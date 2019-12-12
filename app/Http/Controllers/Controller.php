<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}
function XSS($input){
    return preg_replace('/<[\/]{0,1}script>||on[a-z]{4,9}=\".*\"/','',$input);
}
function validateExit($res){
    if(request()->ajax()){
        return response()->json($res, 400);
    }else{
        abort(400,$res['message']);
    }
}
function get_string_between($string, $start, $end){
    $string = ' '.$string;
    $ini = strpos($string, $start);
    if($ini == 0)return '';
    $ini+= strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
