@extends('layouts.admin')
@section('title', 'プロフィールの編集')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <h2>プロフィール編集</h2>
      <form action="{{ action('Admin\ProfileController@update') }}" method="post" enctype="multipart/form-data">
        @if (count($errors) > 0)
        <ul>
          @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
          @endforeach
        </ul>
        @endif
        <div class="form-group row">
          <label class="col-md-2" for="name">氏名</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="name" value="{{ $profile_form->name }}">
            <p>※最大全角50文字</p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2" for="gender">性別</label>
          <div class="col-md-10">
            <input type="radio" name="gender" value="男性" {{ old('gender', '男性') == '男性' ? 'checked' : '' }}>
            <label for="男性">男性</label>
            <input type="radio" name="gender" value="女性" {{ old('gender') == '女性' ? 'checked' : '' }}>
            <label for="女性">女性</label>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2" for="introduction">自己紹介</label>
          <div class="col-md-10">
            <textarea class="form-control" name="introduction" rows="20">{{ $profile_form->introduction }}</textarea>
            <p>※最大全角125文字</p>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-10">
            <input type="hidden" name="id" value="{{ $profile_form->id }}">
            {{ csrf_field() }}
            <input type="submit" class="btn btn-primary" value="更新">
          </div>
        </div>
      </form>
      <div calss="row mt-5">
        <div class="col-md-4 mx-auto">
          <h2>編集履歴</h2>
          <ul class="list-group">
            @if ($profile_form->profile_histories->isEmpty())
            @php
            $latestprofileHistory = $profile_form->profile_histories->last();
            @endphp
            <li class="list-group-item">{{ $latestprofileHistory->edited_at }}</li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
