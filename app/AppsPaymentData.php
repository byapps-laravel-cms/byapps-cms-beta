<?php

namespace App;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use DB;
use Illuminate\Database\Eloquent\Model;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class AppsPaymentData extends Model implements Searchable
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS_apps_payment_data';
  protected $primaryKey = 'idx';
  public $timestamps = false;
  protected $fillable = ['receipt'];

  public static function getPaymentData()
  {
      $paymentData = DB::connection($connection)->table($table)->get();

      return $paymentData;
  }

  public function getSearchResult(): SearchResult
  {
    $url = route('paydetail', $this->idx);

    return new SearchResult($this, $this->app_name, $url);
  }
}
