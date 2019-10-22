<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use DateTime;
use App\AppsData;
use App\PaymentData;
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

        info(strtotime($start));
        info((60*60*24*$term));

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
