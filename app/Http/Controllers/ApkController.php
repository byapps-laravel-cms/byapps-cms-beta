<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\ApkData;
use Yajra\Datatables\Datatables;

class ApkController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getIndex()
  {
      return view('apklist');
  }

  public function getApkData()
  {
    $apkData = ApkData::select('idx',
                            'app_id',
                            'app_process',
                            'app_name',
                            'app_type',
                            'apk_file',
                            'reg_time');

	 $app_process = array("","대기","완료");

    return Datatables::of($apkData)
            ->setRowId(function($apkData) {
              return $apkData->idx;
            })
            ->editColumn('app_process', function($eloquent) use ($app_process){
              return $app_process[$eloquent->app_process];
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $apkData = ApkData::where('idx', $idx)->first();

    return view('apkdetail')->with('apkdata', $apkData);
  }

  public function update(Request $request, $idx)
  {
     $apkData = ApkData::find($idx)->first();

    // $apkData->app_idx = $idx;
     $apkData->apk_file = $this->uploadFilePost();

     dd($apkData->apk_file);

     $apkData->reg_time = Carbon::now()->timestamp;
     $apkData->app_process = 2;

     $apkData->save();

    toastr()->success('APK 등록완료', '', ['timeOut' => 1000, 'positionClass' => 'toast-center-center']);

    return redirect()->back();
  }


  public function uploadFilePost()
  {
    $request = request();

    dd($request);

    // 파일 있는지 확인하고 없으면 null 반환
    if(!$request->hasFile('fileToUpload')) return null;

    // max:8MB
    $request->validate([
        'fileToUpload' => 'required|file|max:8192',
    ]);

    $fileName = "fileName".time().'.'.request()->fileToUpload->getClientOriginalExtension();

    //dd($fileName);

    // $request->fileToUpload->storeAs('public/qnafiles', $fileName);
    Storage::disk('Apkfiles')->put($fileName,file_get_contents($request->file('fileToUpload')));

    return $fileName;
  }
}
