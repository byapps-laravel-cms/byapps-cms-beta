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

    //dd($request->user());


    // $dom = new \DomDocument();
    // $dom->loadHtml($request->add_answer, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    // $images = $dom->getElementsByTagName('img');
    //
    //  foreach($images as $k => $img){
    //
    //      $data = $img->getAttribute('src');
    //      list($type, $data) = explode(';', $data);
    //      list(, $data)      = explode(',', $data);
    //      $data = base64_decode($data);
    //      $image_name= "/storage/qnamember/" . time().$k.'.png';
    //      $path = public_path() . $image_name;
    //      file_put_contents($path, $data);
    //      $img->removeAttribute('src');
    //      $img->setAttribute('src', $image_name);
    //  }
    // $detail = $dom->saveHTML();

    $dom = new \DomDocument();
    $dom->loadHtml($request->add_answer, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $images = $dom->getElementsByTagName('img');
	
	if($images->length > 0) {
		foreach($images as $img){

			 $src = $img->getAttribute('src');
			 // if the img source is 'data-url'
				 if(preg_match('/data:image/', $src)){

					 // get the mimetype
					 preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
					 $mimetype = $groups['mime'];
					 // Generating a random filename
					 $filename = uniqid();
					 $filepath = "/storage/qnamember/$filename.$mimetype";
					 $answer = preg_replace('/data:image.*\"/',$filepath.'"',$request->add_answer);
					 // @see http://image.intervention.io/api/
					 $image = Image::make($src)
					   // resize if required
					   /* ->resize(300, 200) */
					   ->encode($mimetype, 100)  // encode file to the specified mimetype
					   ->save(public_path($filepath));

					  info($image);

					 $new_src = asset($filepath);
					 $img->removeAttribute('src');
					 $img->setAttribute('src', $new_src);
				 } // <!--endif
		 }
	} else {
		$answer = $request->add_answer;
	}
     $detail = $dom->saveHTML();

     $qnaMemberData = QnaMember::where('idx', $idx)->first();
     $answerData = new QnaMember;

     $answerData->pid = $idx;
     $answerData->mem_id = $request->user()->mem_id;
     $answerData->mem_name = $request->user()->mem_name;
     $answerData->subject = "RE: ".$request->subject;
     $answerData->content = $answer;
     $answerData->reg_time = Carbon::now()->timestamp;
     $qnaMemberData->process = 3;

    //dd($answerData);
    $answerData->save();
    $qnaMemberData->save();

    toastr()->success('답변 등록완료', '', ['timeOut' => 1000, 'positionClass' => 'toast-center-center']);

    return redirect()->back();
  }
}
