@extends('layouts.admin')
@section('title', '写真詳細')

@section('content')
<h2>写真詳細</h2>
<div class="container-fluid">
  @if (!is_null($photo))
  <div class="row">
    <div class="headline col-md-12 mx-auto">
      <div class="title p-2">
        <h3>タイトル「{{ str_limit($photo->title, 70) }}」</h3>
      </div>
      <div class="image">
        @if ($photo->image_path)
        <img src="{{ asset('storage/image/' . $photo->image_path) }}">
        @endif
      </div>
      <div>
        <div class="col-md-6">
          <p class="body mx-auto">{{ str_limit($photo->body, 650) }}</p>
        </div>
      </div>
      @endif
    </div>
  </div>
  {{--
  @if (count($likes) == 0)
  <form action="{{ action('LikesController@create') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="photo_id" value={{ $photo->id }}>
    <input type="submit" class="btn btn-primary" value="いいね">
  </form>
  @else
  <form action="{{ action('LikesController@delete') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="photo_id" value={{ $photo->id }}>
    <input type="submit" class="btn btn-primary" value="いいねを解除">
  </form>
  @endif
</div> --}}
@endsection
