<?php

namespace App;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Eloquent\Model;
use DB;

class PaymentData extends Model
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_apps_payment_data';

  public static function getPaymentData()
  {
      $paymentData = DB::connection('byapps')->table('BYAPPS_apps_payment_data')->get();

      // dd($paymentData);

      return $paymentData;
  }

  /**
    * Run the migrations.
    *
    * @return void
    */
  public function up()
  {
  }

  /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('students');
    }
}
