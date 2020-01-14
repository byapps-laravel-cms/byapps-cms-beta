<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use DateTime;
use App\AppsData;
use App\AppsPaymentData;
use App\AppendixOrderData;

class SalesController extends Controller
{
    // 기간 계산
    public function getTerm($start, $end)
    {
      $date1 = new DateTime($start);
      $date2 = new DateTime($end);
      $diff = $date2->diff($date1);

      if ($diff->format('%a') == 0) {
        return 1;
      } else {
        return $diff->format('%a');
      }

    }
    // 플랫폼 데이터
    public function getPlatformData(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        $term = $this->getTerm($start, $end);

        //info(strtotime($start));
        //info((60*60*24*$term));
		
		// 플랫폼 이용수
        // 이번주
        $thisTotal = AppsData::where('app_process', '!=', 8)
                          ->whereBetween('reg_time', [strtotime($start), strtotime($end)])
                          ->count();

        $thisFree = AppsData::where('app_process', '!=', 8)
                          ->whereHas('payments', function (Builder $query) {
                            $query->where('amount', '<', 0);
                          })
                          ->whereBetween('reg_time', [strtotime($start), strtotime($end)])
                          ->count();

        $thisPaid = $thisTotal - $thisFree;

        // 지난주
        $lastTotal = AppsData::where('app_process', '!=', 8)
                          ->whereBetween('reg_time', [strtotime($start) - (60*60*24*$term), strtotime($end) - (60*60*24*$term)])
                          ->count();

        $lastFree = AppsData::where('app_process', '!=', 8)
                          ->whereHas('payments', function (Builder $query) {
                            $query->where('amount', '<', 0);
                          })
                          ->whereBetween('reg_time', [strtotime($start) - (60*60*24*$term), strtotime($end) - (60*60*24*$term)])
                          ->count();

        $lastPaid = $lastTotal - $lastFree;
		
		// 푸쉬자동화 이용수
		// 이번주
        $thisTotalPa = AppsData::leftJoin('BYAPPS_MA_data', 'BYAPPS_apps_data.mem_id', '=', 'BYAPPS_MA_data.mem_id')
					      ->where('BYAPPS_apps_data.app_process', '!=', 8)
						  ->where('BYAPPS_MA_data.auto_push', 'Y')
                          ->whereBetween('BYAPPS_apps_data.reg_time', [strtotime($start), strtotime($end)])
                          ->count();

		$thisFreePa = AppsData::leftJoin('BYAPPS_MA_data', 'BYAPPS_apps_data.mem_id', '=', 'BYAPPS_MA_data.mem_id')
					      ->where('BYAPPS_apps_data.app_process', '!=', 8)
						  ->where('BYAPPS_MA_data.auto_push', 'Y')
						  ->whereHas('payments', function (Builder $query) {
                            $query->where('amount', '<', 0);
                          })
                          ->whereBetween('BYAPPS_apps_data.reg_time', [strtotime($start), strtotime($end)])
                          ->count();

		$thisPaidPa = $thisTotalPa - $thisFreePa;

		// 지난주
        $lastTotalPa = AppsData::leftJoin('BYAPPS_MA_data', 'BYAPPS_apps_data.mem_id', '=', 'BYAPPS_MA_data.mem_id')
					      ->where('BYAPPS_apps_data.app_process', '!=', 8)
						  ->where('BYAPPS_MA_data.auto_push', 'Y')
                          ->whereBetween('BYAPPS_apps_data.reg_time', [strtotime($start) - (60*60*24*$term), strtotime($end) - (60*60*24*$term)])
                          ->count();

		$lastFreePa = AppsData::leftJoin('BYAPPS_MA_data', 'BYAPPS_apps_data.mem_id', '=', 'BYAPPS_MA_data.mem_id')
					      ->where('BYAPPS_apps_data.app_process', '!=', 8)
						  ->where('BYAPPS_MA_data.auto_push', 'Y')
						  ->whereHas('payments', function (Builder $query) {
                            $query->where('amount', '<', 0);
                          })
                          ->whereBetween('BYAPPS_apps_data.reg_time', [strtotime($start) - (60*60*24*$term), strtotime($end) - (60*60*24*$term)])
                          ->count();

		$lastPaidPa = $lastTotalPa - $lastFreePa;

		// MA통합 이용수
		// 이번주
        $thisTotalMi = AppsData::leftJoin('BYAPPS_MA_data', 'BYAPPS_apps_data.mem_id', '=', 'BYAPPS_MA_data.mem_id')
					      ->where('BYAPPS_apps_data.app_process', '!=', 8)
						  ->where('BYAPPS_MA_data.service_ma', 'Y')
                          ->whereBetween('BYAPPS_apps_data.reg_time', [strtotime($start), strtotime($end)])
                          ->count();

		$thisFreeMi = AppsData::leftJoin('BYAPPS_MA_data', 'BYAPPS_apps_data.mem_id', '=', 'BYAPPS_MA_data.mem_id')
					      ->where('BYAPPS_apps_data.app_process', '!=', 8)
						  ->where('BYAPPS_MA_data.service_ma', 'Y')
						  ->whereHas('payments', function (Builder $query) {
                            $query->where('amount', '<', 0);
                          })
                          ->whereBetween('BYAPPS_apps_data.reg_time', [strtotime($start), strtotime($end)])
                          ->count();

		$thisPaidMi = $thisTotalMi - $thisFreeMi;

		// 지난주
        $lastTotalMi = AppsData::leftJoin('BYAPPS_MA_data', 'BYAPPS_apps_data.mem_id', '=', 'BYAPPS_MA_data.mem_id')
					      ->where('BYAPPS_apps_data.app_process', '!=', 8)
						  ->where('BYAPPS_MA_data.service_ma', 'Y')
                          ->whereBetween('BYAPPS_apps_data.reg_time', [strtotime($start) - (60*60*24*$term), strtotime($end) - (60*60*24*$term)])
                          ->count();

		$lastFreeMi = AppsData::leftJoin('BYAPPS_MA_data', 'BYAPPS_apps_data.mem_id', '=', 'BYAPPS_MA_data.mem_id')
					      ->where('BYAPPS_apps_data.app_process', '!=', 8)
						  ->where('BYAPPS_MA_data.service_ma', 'Y')
						  ->whereHas('payments', function (Builder $query) {
                            $query->where('amount', '<', 0);
                          })
                          ->whereBetween('BYAPPS_apps_data.reg_time', [strtotime($start) - (60*60*24*$term), strtotime($end) - (60*60*24*$term)])
                          ->count();

		$lastPaidMi = $lastTotalMi - $lastFreeMi;

		// 리타겟팅 이용수
		// 이번주
        $thisTotalRt = AppsData::leftJoin('BYAPPS_MA_data', 'BYAPPS_apps_data.mem_id', '=', 'BYAPPS_MA_data.mem_id')
					      ->where('BYAPPS_apps_data.app_process', '!=', 8)
						  ->where(function ($query) {
								$query->where('BYAPPS_MA_data.service_type', 'both')
									->orWhere('BYAPPS_MA_data.service_type', 'retarget');
						  })
                          ->whereBetween('BYAPPS_apps_data.reg_time', [strtotime($start), strtotime($end)])
                          ->count();

		$thisFreeRt = AppsData::leftJoin('BYAPPS_MA_data', 'BYAPPS_apps_data.mem_id', '=', 'BYAPPS_MA_data.mem_id')
					      ->where('BYAPPS_apps_data.app_process', '!=', 8)
						  ->where(function ($query) {
								$query->where('BYAPPS_MA_data.service_type', 'both')
									->orWhere('BYAPPS_MA_data.service_type', 'retarget');
						  })
						  ->whereHas('payments', function (Builder $query) {
                            $query->where('amount', '<', 0);
                          })
                          ->whereBetween('BYAPPS_apps_data.reg_time', [strtotime($start), strtotime($end)])
                          ->count();

		$thisPaidRt = $thisTotalRt - $thisFreeRt;

		// 지난주
        $lastTotalRt = AppsData::leftJoin('BYAPPS_MA_data', 'BYAPPS_apps_data.mem_id', '=', 'BYAPPS_MA_data.mem_id')
					      ->where('BYAPPS_apps_data.app_process', '!=', 8)
						  ->where(function ($query) {
								$query->where('BYAPPS_MA_data.service_type', 'both')
									->orWhere('BYAPPS_MA_data.service_type', 'retarget');
						  })
                          ->whereBetween('BYAPPS_apps_data.reg_time', [strtotime($start) - (60*60*24*$term), strtotime($end) - (60*60*24*$term)])
                          ->count();

		$lastFreeRt = AppsData::leftJoin('BYAPPS_MA_data', 'BYAPPS_apps_data.mem_id', '=', 'BYAPPS_MA_data.mem_id')
					      ->where('BYAPPS_apps_data.app_process', '!=', 8)
						  ->where(function ($query) {
								$query->where('BYAPPS_MA_data.service_type', 'both')
									->orWhere('BYAPPS_MA_data.service_type', 'retarget');
						  })
						  ->whereHas('payments', function (Builder $query) {
                            $query->where('amount', '<', 0);
                          })
                          ->whereBetween('BYAPPS_apps_data.reg_time', [strtotime($start) - (60*60*24*$term), strtotime($end) - (60*60*24*$term)])
                          ->count();

		$lastPaidRt = $lastTotalRt - $lastFreeRt;

		// 마케팅오토메이션 이용수
		// 이번주
        $thisTotalMa = AppsData::leftJoin('BYAPPS_MA_data', 'BYAPPS_apps_data.mem_id', '=', 'BYAPPS_MA_data.mem_id')
					      ->where('BYAPPS_apps_data.app_process', '!=', 8)
						  ->where(function ($query) {
								$query->where('BYAPPS_MA_data.service_type', 'both')
									->orWhere('BYAPPS_MA_data.service_type', 'ma');
						  })
                          ->whereBetween('BYAPPS_apps_data.reg_time', [strtotime($start), strtotime($end)])
                          ->count();

		$thisFreeMa = AppsData::leftJoin('BYAPPS_MA_data', 'BYAPPS_apps_data.mem_id', '=', 'BYAPPS_MA_data.mem_id')
					      ->where('BYAPPS_apps_data.app_process', '!=', 8)
						  ->where(function ($query) {
								$query->where('BYAPPS_MA_data.service_type', 'both')
									->orWhere('BYAPPS_MA_data.service_type', 'ma');
						  })
						  ->whereHas('payments', function (Builder $query) {
                            $query->where('amount', '<', 0);
                          })
                          ->whereBetween('BYAPPS_apps_data.reg_time', [strtotime($start), strtotime($end)])
                          ->count();

		$thisPaidMa = $thisTotalMa - $thisFreeMa;

		// 지난주
        $lastTotalMa = AppsData::leftJoin('BYAPPS_MA_data', 'BYAPPS_apps_data.mem_id', '=', 'BYAPPS_MA_data.mem_id')
					      ->where('BYAPPS_apps_data.app_process', '!=', 8)
						  ->where(function ($query) {
								$query->where('BYAPPS_MA_data.service_type', 'both')
									->orWhere('BYAPPS_MA_data.service_type', 'ma');
						  })
                          ->whereBetween('BYAPPS_apps_data.reg_time', [strtotime($start) - (60*60*24*$term), strtotime($end) - (60*60*24*$term)])
                          ->count();

		$lastFreeMa = AppsData::leftJoin('BYAPPS_MA_data', 'BYAPPS_apps_data.mem_id', '=', 'BYAPPS_MA_data.mem_id')
					      ->where('BYAPPS_apps_data.app_process', '!=', 8)
						  ->where(function ($query) {
								$query->where('BYAPPS_MA_data.service_type', 'both')
									->orWhere('BYAPPS_MA_data.service_type', 'ma');
						  })
						  ->whereHas('payments', function (Builder $query) {
                            $query->where('amount', '<', 0);
                          })
                          ->whereBetween('BYAPPS_apps_data.reg_time', [strtotime($start) - (60*60*24*$term), strtotime($end) - (60*60*24*$term)])
                          ->count();

		$lastPaidMa = $lastTotalMa - $lastFreeMa;


        return [
			'Pf' => [
                [
                  'thisTotal' => $thisTotal,
                  'thisPaid' => $thisPaid,
                  'thisFree' => $thisFree
                ],
                [
                  'lastTotal' => $lastTotal,
                  'lastPaid' => $lastPaid,
                  'lastFree' => $lastFree
                ],
             ],
			'Pa' => [
                [
                  'thisTotal' => $thisTotalPa,
                  'thisPaid' => $thisPaidPa,
                  'thisFree' => $thisFreePa
                ],
                [
                  'lastTotal' => $lastTotalPa,
                  'lastPaid' => $lastFreePa,
                  'lastFree' => $lastPaidPa
                ],
             ],
			'Mi' => [
                [
                  'thisTotal' => $thisTotalMi,
                  'thisPaid' => $thisPaidMi,
                  'thisFree' => $thisFreeMi
                ],
                [
                  'lastTotal' => $lastTotalMi,
                  'lastPaid' => $lastFreeMi,
                  'lastFree' => $lastPaidMi
                ],
             ],
			'Rt' => [
                [
                  'thisTotal' => $thisTotalRt,
                  'thisPaid' => $thisPaidRt,
                  'thisFree' => $thisFreeRt
                ],
                [
                  'lastTotal' => $lastTotalRt,
                  'lastPaid' => $lastFreeRt,
                  'lastFree' => $lastPaidRt
                ],
             ],
			'Ma' => [
                [
                  'thisTotal' => $thisTotalMa,
                  'thisPaid' => $thisPaidMa,
                  'thisFree' => $thisFreeMa
                ],
                [
                  'lastTotal' => $lastTotalMa,
                  'lastPaid' => $lastFreeMa,
                  'lastFree' => $lastPaidMa
                ],
             ]
		];
    }

    // MA


}
