<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\PromotionData;
use Yajra\Datatables\Datatables;

class PromotionController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getIndex()
  {
      return view('promolist');
  }

  public function getPromotionData()
  {
    $promotionData = PromotionData::select('idx', 'pm_title', 'mem_id', 'mem_name', 'pm_used', 'pm_target', 'pm_content', 'used_time', 'reg_time');

    return Datatables::of($promotionData)
            ->setRowId(function($promotionData) {
              return $promotionData->idx;
            })
            ->editColumn('mem_name', function($eloquent) {
              return $eloquent->mem_name."(".$eloquent->mem_id.")";
            })
            ->editColumn('pm_used', function($eloquent) {
              if ($eloquent->pm_used == 0) return "미사용";
              else return "사용 ".date('Y-m-d', $eloquent->used_time);
            })
            ->editColumn('pm_target', function($eloquent) {
              if ($eloquent->pm_target == "ma") return "마케팅 오토메이션";
              else return "앱 서비스";
            })
            ->editColumn('pm_content', function($eloquent) {
              $preData = explode(":", $eloquent->pm_content);
              return "월 ".number_format($preData[0])."원 지정결제";
            })
            ->editColumn('reg_time', '{{ date("Y-m-d", $reg_time) }}')
            ->orderColumn('reg_time', 'reg_time $1')
            ->make(true);
  }

  public function getSingleData($idx)
  {
    $promotionData = PromotionData::where('idx', $idx)->first();

    return view('promodetail')->with('promotionData', $promotionData);
  }
}
