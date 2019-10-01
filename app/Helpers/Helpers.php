<?php

namespace App\Helpers;

class Helpers
{
  public static function calculateDday($date)
  {
     $todate = date("Y-m-d", time());
     $dday = intval((strtotime($todate) - strtotime($date)) / 86400);
     return $dday;
  }

  public static function dateFormat($val)
  {
     $dateString = date("Y-m-d", $val);
     return $dateString;
  }

}
