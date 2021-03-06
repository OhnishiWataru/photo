<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

use App\Photo;
use App\Like;

class PhotoController extends Controller
{
    public function index(Request $request)
    {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
        $posts = Photo::where('title', $cond_title).orderBy('updated_at', 'desc')->get();
      } else {
        $posts = Photo::all()->sortByDesc('updated_at');
      }

      if (count($posts) > 0) {
        $headline = $posts->shift();
      } else {
        $headline = null;
      }

      return view('photo.index', ['headline' => $headline, 'posts' => $posts, 'cond_title' => $cond_title]);
     }

     public function profile(Request $request)
     {
       $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $posts = Photo::where('title', $cond_title).orderBy('updated_at', 'desc')->get();
        } else {
            $posts = Photo::all()->sortByDesc('updated_at');
        }

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        return view('photo.profile', compact('headline', 'posts', 'cond_title'));
     }

     public function show(Request $request)
     {
        $photo = Photo::find($request->id);
        $user = \Auth::user();
        $likes = Like::where('photo_id', $photo->id)
        ->where("user_id", $user->id)
        ->get();
        // dd(count($likes));

        $cond_title = $request->cond_title;
         // $cond_title が空白でない場合は、記事を検索して取得する
         if ($cond_title != '') {
             $posts = Photo::where('title', $cond_title).orderBy('updated_at', 'desc')->get();
         } else {
             $posts = Photo::all()->sortByDesc('updated_at');
         }

         if (count($posts) > 0) {
             $headline = $posts->shift();
         } else {
             $headline = null;
         }

        return view('photo.show', ['cond_title' => $cond_title, 'photo' => $photo, 'likes' => $likes]);
     }
}
