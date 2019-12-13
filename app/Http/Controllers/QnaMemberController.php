<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\QnaMember;
use Yajra\Datatables\Datatables;
use Image;

class QnaMemberController extends Controller
{
  public function getIndex()
  {
      return view('qnamemberlist');
  }

  public function getQnaMemberListData()
  {
    $qnaMemberListData = QnaMember::select('idx',
                                  'process',
                                  'subject',
                                  'mem_name',
                                  'email',
                                  'phone',
                                  'reg_time'
                                  );

    $proc_cate = array("","접수","확인중","답변완료");

    return Datatables::of($qnaMemberListData)
            ->setRowId(function($qnaMemberListData) {
                return $qnaMemberListData->idx;
            })
            ->editColumn('process', function($eloquent) use ($proc_cate) {
               return $proc_cate[$eloquent->process];
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
    }

  public function getSingleData($idx)
  {
    $qnaMemberData = QnaMember::where('idx', $idx)->first();

    $replyData = '';
    if ($qnaMemberData->process == 3) {
      $replyData = QnaMember::where('pid', $idx)->get();
    }

    return view('qnamemberdetail')->with('qnaMemberData', $qnaMemberData)
                                  ->with('replyData', $replyData);
  }

  public function create(Request $request, $idx)
  {
     $qnaMemberData = QnaMember::where('idx', $idx)->first();
     $answerData = new QnaMember;

     $answerData->pid = $idx;
     $answerData->mem_id = $request->user()->mem_id;
     $answerData->mem_name = $request->user()->mem_name;
     $answerData->subject = "RE: ".$request->subject;
     $answerData->content = dataToImage($request->add_answer,'QnaMember');
     $answerData->reg_time = Carbon::now()->timestamp;
     $qnaMemberData->process = 3;

    //dd($answerData);
    $answerData->save();
    $qnaMemberData->save();

    toastr()->success('답변 등록완료', '', ['timeOut' => 1000, 'positionClass' => 'toast-center-center']);

    return redirect()->back();
  }
}
