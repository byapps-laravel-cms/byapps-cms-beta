<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\AppsData;
use App\PaymentData;
use App\AppendixOrderData;

class SalesController extends Controller
{

    // 플랫폼 데이터
    public function getPlatformData(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

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
                           ->whereBetween('reg_time', [strtotime($start) - 604800 , strtotime($end) - 604800])
                          ->count();

        $lastFree = AppsData::where('app_process', '!=', 8)
                          ->whereHas('payments', function (Builder $query) {
                            $query->where('amount', '<', 0);
                          })
                          ->whereBetween('reg_time', [strtotime($start) - 604800, strtotime($end) - 604800])
                          ->count();

        $lastPaid = $lastTotal - $lastFree;

        return array(
              array(
                  'thisTotal' => $thisTotal,
                  'thisPaid' => $thisPaid,
                  'thisFree' => $thisFree
                ),
                array(
                  'lastTotal' => $lastTotal,
                  'lastPaid' => $lastPaid,
                  'lastFree' => $lastFree
                ),
              );
    }

    // MA


}
