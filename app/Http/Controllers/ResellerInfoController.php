<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResellerInfo;
use Yajra\Datatables\Datatables;

class ResellerInfoController extends Controller
{
  public function getIndex()
  {
      return view('resellerinfolist');
  }

  public function getResellerInfoListData()
  {
    $resellerInfoListData = ResellerInfo::select('idx',
                                              'mem_id',
                                              'mem_lv',
                                              'company',
                                              'company_owner',
                                              'cellno',
                                              'mem_count',
                                              'ip',
                                              'reg_date'
                                              );

    $reseller_memlv = array("미승인", "승인");

    return Datatables::of($resellerInfoListData)
            ->setRowId(function($resellerInfoListData) {
                return $resellerInfoListData->idx;
            })
            ->editColumn('mem_lv', function($eloquent) use ($reseller_memlv) {
                return $reseller_memlv[$eloquent->mem_lv];
            })
            ->editColumn('reg_date', '{{ date("Y-m-d", strtotime($reg_date)) }}')
            ->orderColumn('reg_date', 'reg_date $1')
            ->make(true);
    }

  public function getSingleData($idx)
  {
    $resellerInfoData = ResellerInfo::where('idx', $idx)->first();

    return view('resellerinfodetail')->with('resellerInfoData', $resellerInfoData);
  }

  public function update(Request $request, $idx)
  {
    $resellerInfoData = ResellerInfo::where('idx', $idx)->first();

    $resellerInfoData->mem_id = $request->input('mem_id');
    $resellerInfoData->company = $request->input('company');
    $resellerInfoData->company_owner = $request->input('company_owner');
    $resellerInfoData->mem_name = $request->input('mem_name');
    $resellerInfoData->mem_email = $request->input('mem_email');
    $resellerInfoData->phoneno = $request->input('phoneno');
    $resellerInfoData->cellno = $request->input('cellno');
    $resellerInfoData->company_no = $request->input('company_no');
    $resellerInfoData->address = $request->input('address');
    $resellerInfoData->company_bank = $request->input('company_bank0').'|'.$request->input('company_bank1').'|'.$request->input('company_bank2');
    $resellerInfoData->returns_percent = $request->input('returns_percent');

    $resellerInfoData->save();

    toastr()->success('업데이트 성공', '', ['timeOut' => 1000, 'positionClass' => 'toast-center-center']);

    return redirect()->back();
  }

  public function updateMemlv()
  {
    $idx = $_POST['idx'];
    $resellerInfoData = ResellerInfo::where('idx', $idx)->first();

    $resellerInfoData->mem_lv = '1';
    $resellerInfoData->save();

    toastr()->success('승인처리 되었습니다', '', ['timeOut' => 1000, 'positionClass' => 'toast-center-center']);

    return redirect()->back();
  }
}
