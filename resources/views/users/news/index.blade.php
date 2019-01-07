@extends('layouts.users')
@section('script')
  <script>
  {{-- 松田変更ここから --}}
  {{ Utl::putConfirmJs('delcnf', '本当に削除しますか？') }}
  {{-- 松田変更ここまで --}}
  </script>
@endsection

@section('title', '登録済みニュースの一覧')

@section('content')
    <div class="container users-index">
        <div class="row">
            <h2 style="margin-bottom:30px">ニュース一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4 l-pad-l">
                <a href="{{ action('Users\NewsController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Users\NewsController@index') }}" method="get">
                    <div class="form-group row l-mg-rl">
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
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr class="header">
                                <th class="news-table__date">日時</th>
                                <th class="news-table__title">タイトル</th>
                                <th class="news-table__body">本文</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- 松田変更ここから --}}
                            @each('users/news/_news_item', $posts, 'news')
                            {{-- 松田変更ここまで --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
