<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    protected $guarded = array('id');

    public static $rules = array(
      'title' => 'required',
    );

    public function histories()
    {
      return $this->hasMany('App\History');
    }

}
