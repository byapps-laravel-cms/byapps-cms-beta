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
			  else return '<div class="img-centercrop" style="width:15rem"><img src="/storage/member/apps/news/'.$eloquent->app_id.'/'.$eloquent->content.'"></div>';
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

  public function update($idx)
  {
	if(PushNewsData::where('idx','=',$idx)->count() == 0) abort(404);
	$data = request()->only(['app_id','pm_used','content','content_type']);

	$model = PushNewsData::find($idx);
	
	if($data['pm_used']) {
		$model->delete();
		if( $data['content_type']=="img" ){
			if(file_exists("../../../storage/member/news/".$data['app_id']."/".$data['content']) ) unlink("../../../storage/member/news/".$data['app_id']."/".$data['content']);
		}
	} else {
		$_f = [
			'content' => $data['content'],
			'content_type' => $data['content_type'],
		];

		$model->update($_f);
	}
	
	toastr()->success('업데이트 성공', '', ['timeOut' => 1000, 'positionClass' => 'toast-center-center']);

	return $data['pm_used'] ? redirect()->route('pushnewslist.view'): redirect()->back();
  }
}
