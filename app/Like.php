<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $counterCacheOptions = [
      'Post' => [
          'field' => 'likes_count',
          'foreignKey' => 'photo_id'
        ]
    ];

    protected $fillable = ['user_id', 'photo_id'];

      public function Photo()
      {
        return $this->belongsTo('App\Photo');
      }

      public function User()
      {
        return $this->belongsTo(User::class);
      }

}
