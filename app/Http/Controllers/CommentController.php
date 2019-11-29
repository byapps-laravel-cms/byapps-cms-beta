<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $colmus;
    public function __construct(){
        $this->colmus = ['mem_name','reg_time','comment','mmid'];
    }
    public function __invoke(){
        if(request()->ajax()){
            $data = \App\Comment::where('pidx',request()->input('idx'));
            if(request()->input('mmid') != 'all'){
                $data->where('mmid',request()->input('mmid'));
            }
            return $data->orderBy('reg_time','desc')->get($this->colmus);
        }
    }

    public function send(){
        $data = request()->only(['pidx','mmid','comment']);
        $data['mmid'] = request()->input('mmid') == 'all' ? 'apps' : request()->input('mmid');
        $data['pmid'] = request()->user()->email;
        $data['mem_name'] = request()->user()->mem_name;
        $data['mem_id'] = request()->user()->user_id;
        $data['reg_time'] = time();
        return \App\Comment::find(\App\Comment::insertGetId($data),$this->colmus);
    }
}
