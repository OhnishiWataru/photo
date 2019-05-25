@extends('layouts.admin')
@section('title', '登録済みのフォトの一覧')

@section('content')
  <div class="container">
    <div class="row">
      <h2>フォト一覧</h2>
    </div>
    <div class="row">
      <div class="col-md-4">
        <a href="{{ action('Admin\PhotoController@add') }}" role="button" class="btn btn-primary">📤  新規作成</a>
      </div>
      <div class="col-md-8">
        <form action="{{ action('Admin\PhotoController@index') }}" method="get">
          <div class="form-group row">
            <label class="col-md-2">タイトル</label>
            <div class="col-md-8">
              <input type="text" class="form-control" name="cond_title" value={{ $cond_title }}>
            </div>
            <div class="col-md-2">
              {{ csrf_field() }}
              <input type="submit" class="btn btn-primary" value="検索">
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="admin-photo col-md-12 mx-auto">
        <div class="row">
          <table class="table table-dark">
            <thead>
              <tr>
                <th width="10%">ID</th>
                <th width="10%">タイトル</th>
                <th width="20%">撮影日</th>
                <th width="40%">コメント</th>
              </tr>
            </thead>
            <tbody>
              @foreach($posts as $photo)
                <tr>
                  <th>{{ $photo->id }}</th>
                  <td>{{ str_limit($photo->title, 100) }}</td>
                  <td>
                    {{ str_limit($photo->year, 100) }}/
                    {{ str_limit($photo->month, 100) }}/
                    {{ str_limit($photo->day, 100) }}
                  </td>
                  <td>{{ str_limit($photo->body, 250) }}</td>
                  <td>
                    <div>
                      <a href="{{ action('Admin\PhotoController@edit', ['id' => $photo->id]) }}">編集</a>
                    </div>
                    <div>
                      <a href="{{ action('Admin\PhotoController@delete', ['id' => $photo->id]) }}">削除</a>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
