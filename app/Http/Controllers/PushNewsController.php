<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PushNewsData;
use Yajra\Datatables\Datatables;

class PushNewsController extends Controller
{
  public function getIndex()
  {
      return view('pushnewslist');
  }

  public function getPushNewsListData()
  {
    $pushnewslistData = PushNewsData::select('idx',
                                           'app_id',
                                           'app_name',
                                           'content',
                                           'android_view',
                                           'ios_view',
                                           'reg_time',
											'content_type');

    return Datatables::of($pushnewslistData)
            ->setRowId(function($pushnewslistData) {
                return $pushnewslistData->idx;
            })
            ->editColumn('content', function($eloquent) {
              if($eloquent->content_type != "img") return '<div style="width: 55rem; overflow:hidden; text-overflow: ellipsis; white-space: nowrap;">'.$eloquent->content.'</div>';
			  else return '<div class="img-centercrop" style="width:15rem"><img src="/member/apps/news/'.$eloquent->app_id.'/'.$eloquent->content.'"></div>';
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
			->rawColumns(['content'])
            ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $pushNewsData = PushNewsData::where('idx', $idx)->first();

    return view('pushnewsdetail')->with('pushNewsData', $pushNewsData);
  }
}
