{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'新規投稿'を埋め込む --}}
@section('title', '新規投稿')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h2>新規投稿</h2>
        <form action="{{ action('Admin\PhotoController@create') }}" method="post" enctype="multipart/form-data">

          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
          <div class="form-group row">
            <label class="col-md-2" for="title">タイトル<p class="hissu">[必須]</p></label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="title" value="{{ old('title') }}">
              <p>※最大全角50文字</p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="title">画像<p class="hissu">[必須]</p></label>
            <div class="col-md-10">
              <input type="file" class="form-control-file" name="image">
            </div>
          </div>
          <div class="from-gropu row">
            <label class="col-md-2">撮影日<p class="hissu"></p></label>
              <div class="col-md-10">
              <p>
                <!-- <input type="text" name="year" value="{{ old('year') }}"> -->
                {{Form::selectRange('year', 2015, 2030, '', ['placeholder' => ''])}}年

                @if($errors->has('year'))
                  <span class="error">{{ $errors->first('year') }}</span>
                @endif
              </p>
              <p>
                <!-- <input type="text" name="month" value="{{ old('month') }}"> -->
                {{Form::selectRange('month', 1, 12, '', ['placeholder' => ''])}}月

                @if($errors->has('month'))
                  <span class="error">{{ $errors->first('month') }}</span>
                @endif
              </p>
              <p>
                <!-- <input type="text" name="day" value="{{ old('day') }}"> -->
                {{Form::selectRange('day', 1, 31, '', ['placeholder' => ''])}}日

                @if($errors->has('day'))
                  <span class="error">{{ $errors->first('day') }}</span>
                @endif
              </p>
              </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="body">説明<p class="hissu"></p></label>
            <div class="col-md-10">
              <textarea class="form-control" name="body" rows="5">{{ old('body') }}</textarea>
              <p>※最大全角125文字</p>
            </div>
          </div>
          {{ csrf_field() }}
          <input type="submit" class="btn btn-primary" value="投稿">
        </form>
      </div>
    </div>
  </div>
@endsection
