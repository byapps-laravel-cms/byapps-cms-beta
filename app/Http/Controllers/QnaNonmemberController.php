<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\QnaNonmember;
use App\Comment;
use Yajra\Datatables\Datatables;

class QnaNonmemberController extends Controller
{
  public function getIndex()
  {
      return view('qnanonmemberlist');
  }

  public function getQnaNonmemberListData()
  {
    $qnaNonmemberListData = QnaNonmember::select('idx',
                                  'process',
                                  'company',
                                  'name',
                                  'email',
                                  'phone',
                                  'reg_date'
                                  );

    $proc_cate = array("","접수","상담완료");

    return Datatables::of($qnaNonmemberListData)
            ->setRowId(function($qnaNonmemberListData) {
                return $qnaNonmemberListData->idx;
            })
            ->editColumn('process', function($eloquent) use ($proc_cate) {
              return $proc_cate[$eloquent->process];
            })
            ->orderColumn('reg_date', 'reg_date $1')
            ->make(true);
    }

  public function getSingleData($idx)
  {
    $qnaNonmemberData = QnaNonmember::where('idx', $idx)->first();

    return view('qnanonmemberdetail')->with('qnaNonmemberData', $qnaNonmemberData);
  }

  public function update(Request $request, $idx)
  {
    $qnaNonmemberData = QnaNonmember::where('idx', $idx)->first();
    $qnaNonmemberData->process = '2';

    $commentData = new Comment;
    $commentData->mmid = 'csqna';
    $commentData->pidx = $idx;
    $commentData->pmid = $qnaNonmemberData->email;
    $commentData->mem_id = $request->user()->mem_id;
    $commentData->mem_name = $request->user()->mem_name;
    $commentData->comment = "상담완료처리";
    $commentData->reg_time = Carbon::now()->timestamp;

    //dd($commentData);

    $qnaNonmemberData->save();
    $commentData->save();

    toastr()->success('상담완료 처리', '', ['timeOut' => 1000, 'positionClass' => 'toast-center-center']);

    return redirect()->back();
  }
}
