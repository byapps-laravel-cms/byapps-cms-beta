<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests;
use DB;
use App\PaymentData;
use Yajra\Datatables\Datatables;
//use App\DataTables\PaylistDataTable;

class PaymentController extends Controller
{
  public function getIndex()
    {
        // $paymentData = new PaymentData;
        // $paymentData->getPaymentData();

        return view('paylist');
    }
  /**
   * Displays datatables front end view
   *
   * @return \Illuminate\View\View
   */
  // public function index(PaylistDataTable $dataTable)
  // {
  //     return $dataTable->render('paylist');
  // }

  public function getData()
    {
        return Datatables::of(PaymentData::query())->make(true);

        //$paymentData = DB::connection('byapps')->table('BYAPPS_apps_payment_data')->select('idx', 'app_name', 'pay_type', 'term', 'amount', 'reg_time');

        //return Datatables::of($paymentData)->make(true);
    }

}
