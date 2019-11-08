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
                ->make('true');
  }

  public function getSingleData($idx)
  {
    $cafe24ApiTokenData = Cafe24ApiToken::where('idx', $idx)->first();

    return view('cafe24tokendetail')->with('cafe24ApiTokenData', $cafe24ApiTokenData);
  }

}
