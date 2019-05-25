<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
  protected $guarded = array('id');

  public static $rules = array(
    'user_id' => 'required',
  );
}
