<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeLayout extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_cd', 'squence', 'layout_name',
  ];
}
