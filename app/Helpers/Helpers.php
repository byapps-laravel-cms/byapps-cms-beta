<?php

namespace App\Helpers;

class Helpers
{
  // 오늘 기준 입력날짜 d-day 계산
  public static function calculateDday($date)
  {
     $todate = date("Y-m-d", time());
     $dday = intval((strtotime($todate) - strtotime($date)) / 86400);
     return $dday;
  }

  // unix_timestamp를 'Y-m-d' 연월일로 변경
  public static function dateFormat($val)
  {
     $dateString = date("Y-m-d", $val);
     return $dateString;
  }

}
