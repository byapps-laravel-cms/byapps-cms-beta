<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\PromotionData;
use Yajra\Datatables\Datatables;

class PromotionController extends Controller
{
  public function getIndex()
  {
      return view('promolist');
  }

  public function getPromotionData()
  {
    $promotionData = PromotionData::select('idx', 'pm_title', 'mem_name', 'pm_used', 'pm_target', 'pm_comment', 'reg_time');

    return Datatables::of($promotionData)
            ->setRowId(function($promotionData) {
              return $promotionData->idx;
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $promotionData = PromotionData::where('idx', $idx)->first();

    return view('promodetail')->with('paymentData', $promotionData);
  }

}
