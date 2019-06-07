<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Photo;

use App\History;

use Carbon\Carbon;

use Storage;

class PhotoController extends Controller
{
    public function add()
    {
      return view('admin.photo.create');
    }

    public function create(Request $request)
    {
      $this->validate($request, [
        'title' => 'required',
        'image' => 'required',
      ]);
      $user = \Auth::user();
      $photo = new Photo;
      $photo->id = $request->id;
      $photo->title = $request->title;
      $photo->image_path = $request->image_path;
      $photo->year = $request->year;
      $photo->month = $request->month;
      $photo->day = $request->day;
      $photo->body = $request->body;
      $photo->user_id = $user->id;

      $form = $request->all();

      if ($form['image']) {
        $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        $photo->image_path = Storage::disk('s3')->url($path);
      } else {
          $photo->image_path = null;
      }

      unset($form['_token']);
      unset($form['image']);

      $photo->timestamps = false;
      $photo->fill($form);
      $photo->save();

      return redirect('admin/photo/');
    }

    public function index(Request $request)
    {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
        $posts = Photo::where('title', $cond_title)->get();
      } else {
        $posts = Photo::all();
      }

      $posts = Photo::orderBy('year', 'asc')->orderBy('month', 'asc')->orderBy('day', 'asc')->get();
      //dd($posts);
      return view('admin.photo.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    public function edit(Request $request)
    {
      $photo = Photo::find($request->id);

      return view('admin.photo.edit', ['photo_form' => $photo]);
    }

    public function update(Request $request)
    {
      $this->validate($request, Photo::$rules);
      $photo = Photo::find($request->id);
      $photo_form = $request->all();
      if ($request->remove == 'true') {
          $photo_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
          $photo_form->image_path = Storage::disk('s3')->url($path);
      } else {
          $photo_form['image_path'] = $photo->image_path;
      }
      unset($photo_form['_token']);
      unset($photo_form['image']);
      unset($photo_form['remove']);

      $photo->fill($photo_form)->save();

      $history = new History;
      $history->photo_id = $photo->id;
      $history->edited_at = Carbon::now();
      $history->save();

      return redirect('admin/photo/');
    }

    public function delete(Request $request)
    {
      $photo = Photo::find($request->id);
      $photo->delete();
      return redirect('admin/photo/');
    }

    public function show(Request $request)
    {
      $photo = Photo::find($request->user_id);
      return view('admin.photo.show');
    }
}
