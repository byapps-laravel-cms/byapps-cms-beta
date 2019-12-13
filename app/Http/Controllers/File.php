<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class File extends Controller
{
    public function view(){
        try {
            $per = request()->user()->adminNMNew;
        } catch (\Exception $e) {
            abort(404);
        }
        if($per == 'all' || strpos($per,'|'.request()->input('disk').'detail'.'|') > -1)
            return \Response
                ::make(\Storage::disk(request()->input('disk'))->get(request()->input('path')),200)
                ->header('Content-Type','image/jpg');
        abort(404);
    }
}
