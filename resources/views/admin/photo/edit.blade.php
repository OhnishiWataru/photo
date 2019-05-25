@extends('layouts.admin')
@section('title', '投稿編集')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h2>投稿編集</h2>
        <form action="{{ action('Admin\PhotoController@update') }}" method="post" enctype="multipart/form-data">
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
              <input type="text" class="form-control" name="title" value="{{ $photo_form->title }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="title">画像<p class="hissu">[必須]</p></label>
            <div class="col-md-10">
              @if (empty($photo_form->image_path))
                <input type="file" class="form-control-file" name="image" value="{{ $photo_form->image_path }}">
              @else
                <div class="form-text text-info">
                  設定中: {{ $photo_form->image_path }}
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="remove" value="ture">画像を削除
                  </label>
                </div>
              </div>
            @endif
          </div>
          <div class="from-gropu row">
            <label class="col-md-2" for="shooting">撮影日<p class="hissu">[必須]</p></label>
              <div class="col-md-10">
              <p>
                <!-- <input type="text" name="year" value="{{ old('year') }}"> -->
                {{Form::selectRange('year', 2015, 2030, $photo_form->year, ['placeholder' => ''])}}年

                @if($errors->has('year'))
                  <span class="error">{{ $errors->first('year') }}</span>
                @endif
              </p>
              <p>
                <!-- <input type="text" name="month" value="{{ old('month') }}"> -->
                {{Form::selectRange('month', 1, 12, $photo_form->month, ['placeholder' => ''])}}月

                @if($errors->has('month'))
                  <span class="error">{{ $errors->first('month') }}</span>
                @endif
              </p>
              <p>
                <!-- <input type="text" name="day" value="{{ old('day') }}"> -->
                {{Form::selectRange('day', 1, 31, $photo_form->day, ['placeholder' => ''])}}日

                @if($errors->has('day'))
                  <span class="error">{{ $errors->first('day') }}</span>
                @endif
              </p>
              </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="body">説明<p class="hissu">[必須]</p></label>
            <div class="col-md-10">
              <textarea class="form-control" name="body" rows="20">{{ $photo_form->body }}</textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-10">
              <input type="hidden" name="id" value="{{ $photo_form->id }}">
              {{ csrf_field() }}
              <input type="submit" class="btn btn-primary" value="投稿">
            </div>
          </div>
        </form>
        <div calss="row mt-5">
          <div class="col-md-4 mx-auto">
            <h2>編集履歴</h2>
            <ul calss="list-group">
              @if (!$photo_form->histories->isEmpty())
                @php
                  //$historyArray = $photo_form->histories->toArray();
                  //$latestHistory = array_pop($historyArray);
                  $latestHistory = $photo_form->histories->last();
                  //dd($photo_form->histories;
                @endphp
                <li class="list-group-item">{{ $latestHistory->edited_at }}</li>
              @endif
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
