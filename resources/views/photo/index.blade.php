@extends('layouts.front')

@section('content')
  <div class="container">
    <div class="col-md-4">
      <a href="{{ action('Admin\PhotoController@add') }}" role="button" class="btn btn-primary">📤  新規投稿</a>
    </div>
    <hr color="#c0c0c0">
    @if (!is_null($headline))
      <div class="row">
        <div class="headline col-md-10 mx-auto">
          <div class="row">
            <div class="col-md-6">
              <div class="caption mx-auto">
                <div class="title">
                  <h1>{{ str_limit($headline->title, 70) }}</h1>
                </div>
                <div class="image">
                  @if ($headline->image_path)
                    <a href="{{ action('PhotoController@show', $headline->id )}}">
                      <img src="{{ $headline->image_path }}">
                    </a>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <p class="body mx-auto">{{ str_limit($headline->body, 650) }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
    <hr color="#c0c0c0">
    <div class="row">
      <div class="posts col-md-8 mx-auto mt-3">
        @foreach($posts as $post)
          <div class="post">
            <div class="row">
              <div class="text col-md-6">
                <div class="title">
                  {{ str_limit($post->title, 150) }}
                </div>
                <div class="body mt-3">
                  {{ str_limit($post->body, 1500) }}
                </div>
              </div>
              <div class="image col-md-6 text-right mt-4">
                @if ($post->image_path)
                <a href="{{ action('PhotoController@show', $post->id )}}">
                  <img src="{{ $post->image_path }}">
                </a>
                @endif
              </div>
            </div>
          </div>
          <hr color="#c0c0c0">
        @endforeach
      </div>
    </div>
  </div>
  </div>
@endsection
