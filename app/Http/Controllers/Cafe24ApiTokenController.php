<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use App\Cafe24ApiToken;

class Cafe24ApiTokenController extends Controller
{
  public function getIndex()
  {
      return view('cafe24tokenlist');
  }

  public function getCafe24ApiTokenData()
  {
    $cafe24ApiTokenData = Cafe24ApiToken::select('idx',
                                                'mem_id',
                                                'app_id',
                                                'mall_id',
                                                'shop_no',
                                                'access_token',
                                                'refresh_token',
                                                'mileage_enable',
                                                'refresh_date',
                                                'issued_date'
                                              );

      return Datatables::of($cafe24ApiTokenData)
                ->setRowId(function($cafe24ApiTokenData) {
                  return $cafe24ApiTokenData->idx;
                })
                ->editColumn('mall_id', function($eloquent) {
                  return $eloquent->mall_id." (".$eloquent->shop_no.")";
                })
                ->editColumn('app_id', function($eloquent) {
                  if (!$eloquent->app_id) {
                    return "신규";
                  } else {
                    return $eloquent->app_id;
                  }
                })
                ->editColumn('mem_id', function($eloquent) {
                  if (!$eloquent->mem_id) {
                    return "비회원";
                  } else {
                    return $eloquent->mem_id;
                  }
                })
                ->make('true');
  }

  public function getSingleData($idx)
  {
    $cafe24ApiTokenData = Cafe24ApiToken::where('idx', $idx)->first();

    return view('cafe24tokendetail')->with('cafe24ApiTokenData', $cafe24ApiTokenData);
  }

  public function update(Request $request, $idx)
  {
    $cafe24ApiTokenData = Cafe24ApiToken::where('idx', $idx)->first();

    $cafe24ApiTokenData->mem_id = $request->input('mem_id');
    $cafe24ApiTokenData->app_id = $request->input('app_id');
    $cafe24ApiTokenData->order_no = $request->input('order_no');
    $cafe24ApiTokenData->save();

    //Session::flash('success', '업데이트 성공');
    toastr()->success('업데이트 성공', '', ['timeOut' => 1000, 'positionClass' => 'toast-center-center']);

    return redirect()->back();
  }

}
