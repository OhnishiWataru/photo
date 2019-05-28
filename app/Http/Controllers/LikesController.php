<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Like;
use Auth;
use App\Post;

class LikesController extends Controller
{
    public function create(Request $request) {
      $form = $request->all();
      $user = \Auth::user();
      $like = new Like;
      $like->user_id = $user->id;
      $like->photo_id = $form['photo_id'];

      unset($form['_token']);

      //$like->fill($form);
      $like->save();

      return redirect()
            ->action('PhotoController@show', ['id' => $form['photo_id'] ]);
    }

    public function index(Request $request) {
      $posts = Photo::findOrFail($posts);
      $posts->like_by()->findOrFail($likes)->delete();

      return redirect()
             ->action('PhotoController@show', $posts->id);
    }

    public function delete(Request $request) {
      $form = $request->all();
      $user = \Auth::user();
      $like = new Like;
      $like->user_id = $user->id;
      $like->photo_id = $form['photo_id'];
      $like->delete();

      return redirect()
              ->action('PhotoController@show', ['id' => $form['photo_id'] ]);
    }zzz
}
