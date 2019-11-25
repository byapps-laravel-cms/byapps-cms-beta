<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\AppsPaymentData;

class SalesChartController extends Controller
{
  // 매출 통계 월간 or 검색
  public function onGetSalesTermChartData(Request $request)
  {
    // mktime (시, 분, 초, 월, 일, 년)
    // $from = mktime(0, 0, 0, date("03"), date("d"), date("Y"));
    // $to = mktime(23, 59, 59, date("03"), date("d"), date("Y"));
    $from = strtotime($request->date1);
    $to = strtotime($request->date2);
	
	if($request->gubun == 'S') {
		$salesTotal = AppsPaymentData::where('process', '=', '1')
					  ->whereBetween('reg_time', [$from, $to])
					  ->orderBy('idx', 'asc')
					  ->sum('amount');

		//info(gettype($salesTotal);

		// 신규
		$salesNew = AppsPaymentData::where('process', '=', '1')
					->whereBetween('reg_time', [$from, $to])
					->orderBy('idx', 'asc')
					->sum(DB::Raw("case when pay_type='0' then amount end"));

		// 연장
		$salesCon = AppsPaymentData::where('process', '=', '1')
					->whereBetween('reg_time', [$from, $to])
					->orderBy('idx', 'asc')
					->sum(DB::Raw("case when pay_type='1' then amount end"));
		
		$salesEtc = $salesTotal - ($salesNew + $salesCon);
	} elseif($request->gubun == 'M') {
		$oldym=date("Y-m",strtotime($request->date1));

		$sales = AppsPaymentData::where('process', '=', '1')
						->whereBetween('reg_time', [$from, $to])
						->orderBy('reg_time', 'asc')
						->select('amount','reg_time','pay_type')->get()->toArray();

		$total=0;
		$keep=0;
		$new=0;
		$total_n=0;
		$keep_n=0;
		$new_n=0;
		$i=1;		
		
		if($sales) {
			$month[0]="x";
			$salesTotal[0]="전체";
			$salesNew[0]="신규";
			$salesCon[0]="연장";
			$salesEtc[0]="기타";
			foreach($sales as $valu) {
				$ym=date("Y-m",$valu['reg_time']);
				if($oldym!=$ym){
					$salesTotal[$i]=$total;
					$salesNew[$i]=$keep;
					$salesCon[$i]=$new;
					$salesEtc[$i]=$total - ($new+$keep);
					$month[]=$oldym;
					$oldym=$ym;
					$total=$valu['amount'];
					$keep=0;
					$new=0;
					if($valu['pay_type']=="1") $keep=$valu['amount'];
					elseif($valu['pay_type']=="0") $new=$valu['amount'];
					$i++;
				}else{
					$total+=$valu['amount'];
					$total_n++;
					if($valu['pay_type']=="1") $keep+=$valu['amount'];
					elseif($valu['pay_type']=="0") $new+=$valu['amount'];
				}
			}
			$month[]=$ym;
			$salesTotal[$i]=$total;
			$salesNew[$i]=$keep;
			$salesCon[$i]=$new;
			$salesEtc[$i]=$total - ($new+$keep);
		} else {
			$month=0;
			$salesTotal=0;
			$salesNew=0;
			$salesCon=0;
			$salesEtc=0;
		}
	}
	
	if($request->gubun == 'S') {
		$result = array(
		  'bar' => array(
			  array('전체', $salesTotal),
			  array('신규', $salesNew),
			  array('연장', $salesCon),
			  array('기타', $salesEtc),
		  )
		);
	} elseif($request->gubun == 'M') {
		$result = array(
		  'line' => array(
			  $month,
			  $salesTotal,
			  $salesNew,
			  $salesCon,
			  $salesEtc,
		  ),
		);
	}

    return $result;
  }

  // 매출 통계 (default)
  public function onGetSalesChartData(Request $request = NULL)
  {
    // 전체
    // origianl query: SELECT sum(amount) as total, sum(case when pay_type='0' then amount end) as newt, sum(case when pay_type='1' then amount end) as con
    //                 FROM BYAPPS_apps_payment_data where process=1 and (reg_time between '".get_mktime(date("Y-m")."-01-0-0-0")."' and '".get_mktime(date("Y-m")."-31-23-59-59")."')
    //                 order by idx asc
    // SELECT sum(amount) as total, sum(case when pay_type='0' then amount end) as newt, sum(case when pay_type='1' then amount end) as con
    // FROM BYAPPS_apps_payment_data where process=1 and (reg_time between unix_timestamp('2019-03-01 00:00:00') and unix_timestamp('2019-03-31 23:59:59')) order by idx asc
	
    //$from = mktime(0, 0, 0, date("01"), 01, 2017);
    //$to = mktime(23, 59, 59, date("03"), 31, 2018);
	if(isset($request->gubun) && $request->gubun == 'T') {
		$from = $request->date1;
		$to = $request->date2;
	} else {
		$from = strtotime("-1 years");
		$to = strtotime("now");
	}

    $salesTotal = AppsPaymentData::where('process', '=', '1')
                  ->whereBetween('reg_time', [$from, $to])
                  ->orderBy('idx', 'asc')
                  ->sum('amount');

    // 신규
    $salesNew = AppsPaymentData::where('process', '=', '1')
                ->whereBetween('reg_time', [$from, $to])
                ->orderBy('idx', 'asc')
                ->sum(DB::Raw("case when pay_type='0' then amount end"));

    // 연장
    $salesCon = AppsPaymentData::where('process', '=', '1')
                ->whereBetween('reg_time', [$from, $to])
                ->orderBy('idx', 'asc')
                ->sum(DB::Raw("case when pay_type='1' then amount end"));

    $salesEtc = $salesTotal - ($salesNew + $salesCon);

    $result = [
      'bar' => [
          ['전체', $salesTotal],
          ['신규', $salesNew],
          ['연장', $salesCon],
          ['기타', $salesEtc],
      ]
    ];

    return $result;
  }

  public function index() {

    $result = array(
      'bar' => $this->onGetSalesChartData()['bar']
    );

    return $result;
  }
}
