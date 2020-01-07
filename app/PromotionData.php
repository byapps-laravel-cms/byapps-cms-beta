<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class PromotionData extends Model implements Searchable
{
  protected $connection = 'byapps';
  protected $table = 'BYAPPS2016_promotion_data';

  public static function getPaymentData()
  {
      $promotionData = DB::connection($connection)->table($table)->get();

      dd($promotionData);

      return $promotionData;
  }

  public function getSearchResult(): SearchResult
  {
    $url = route('promodetail', $this->idx);

    return new SearchResult($this, $this->mem_name, $url, $this->reg_time);
  }
}
