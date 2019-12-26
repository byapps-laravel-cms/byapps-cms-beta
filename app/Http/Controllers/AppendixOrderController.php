<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppendixOrderData;
use Yajra\Datatables\Datatables;

class AppendixOrderController extends Controller
{
  public function getIndex()
  {
      return view('appendixorderlist');
  }

  public function getAppendixOrderListData()
  {
    $appendixOrderListData = AppendixOrderData::select('idx',
                                             'app_process',
                                             'service_type',
                                             'pay_way',
                                             'receipt',
                                             'order_name',
                                             'app_company',
                                             'cellno',
                                             'reg_time');

   $app_process = array("주문취소","접수","주문확인","SDK설치중","설치완료","서비스중지","서비스해지");

    return Datatables::of($appendixOrderListData)
            ->setRowId(function($appendixOrderListData) {
                return $appendixOrderListData->idx;
            })
            ->editColumn('app_process', function($eloquent) use ($app_process) {
              return $app_process[$eloquent->app_process];
            })
            ->editColumn('service_type', function($eloquent) {
              if ($eloquent->service_type == 'ma') {
                return "마케팅 오토메이션";
              } else {
                return "리타겟팅";
              }
            })
            ->editColumn('receipt', function($eloquent) {
              return $eloquent->receipt == '' ? "미발행" : "발행";
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
	$app_process = array("주문취소","접수","주문확인","SDK설치중","설치완료","서비스중지","서비스해지");

    $appendixOrderData = AppendixOrderData::where('idx', $idx)->first();
	
	$app_proc=$app_process[$appendixOrderData->app_process];
	if($appendixOrderData->app_process == 1) $app_proc.=" <input type='button' value='주문확인' class='btn btn-primary btn-xs'>";
	elseif($appendixOrderData->app_process == 2) $app_proc.=" <input type='button' value='SDK설치진행' class='btn btn-primary btn-xs'>";
	
	$btn_cancel = "";
	if($appendixOrderData->app_process != 0 && $appendixOrderData->app_process <= 4) $btn_cancel="<a href='javascript:void(0)' class='btn btn-danger btn-xs'>주문취소</a>";
	
	$payment="미결제";
	if($appendixOrderData->payment && $appendixOrderData->payment != "무통장입금"){
		$payment=$appendixOrderData->pay_way;
		$p_info=explode("{:}", $appendixOrderData->payment);
		$p_time=substr($p_info[2],0,4)."/".substr($p_info[2],4,2)."/".substr($p_info[2],6,2)." [".substr($p_info[2],8,2).":".substr($p_info[2],10,2)."]";
		$payment.="(".$p_info[1].", 승인번호: ".$p_info[3].", 승인날짜: ".$p_time.")";
	}

	$phone=explode("-", $appendixOrderData->cellno);
	if(preg_match("/010|011|016|017|018|019/i",$phone[0])) $btn_sms = " <input type='button' value='SMS보내기' class='btn btn-primary btn-xs'>";
	else $btn_sms="";

	$order_option=explode("|", $appendixOrderData->order_option);

	if($appendixOrderData->receipt) $appendixOrderData->receipt=str_replace("|","\n", $appendixOrderData->receipt);
	else $appendixOrderData->receipt="미발행";

	$valu = [
		'idx' => $appendixOrderData->idx,
		'mem_id' => $appendixOrderData->mem_id,
		'service_type' => $appendixOrderData->service_type,
		'app_process' => $appendixOrderData->app_process,
		'order_id' => $appendixOrderData->order_id,
		'btn_cancel' => $btn_cancel,
		'reg_time' => date("Y-m-d [H:i:s]", $appendixOrderData->reg_time),
		'app_proc' => $app_proc,
		'app_company' => $appendixOrderData->app_company,
		'order_name' => $appendixOrderData->order_name,
		'cellno' => $appendixOrderData->cellno,
		'btn_sms' => $btn_sms,
		'email' => $appendixOrderData->email,
		'payment' => $payment,
		'receipt' => $appendixOrderData->receipt,
	];

    return view('appendixorderdetail')->with('valu', $valu);
  }

  public function update(Request $request, $idx)
  {
	$appendixOrderData = AppendixOrderData::where('idx', $idx)->first();

	$appendixOrderData->receipt = $request->input('receipt');
	$appendixOrderData->save();

	//Session::flash('success', '업데이트 성공');
	toastr()->success('업데이트 성공', '', ['timeOut' => 1000, 'positionClass' => 'toast-center-center']);

	return redirect()->back();
  }
}
