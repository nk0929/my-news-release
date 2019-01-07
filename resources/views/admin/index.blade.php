@extends('layouts.admin')
@section('title', 'ユーザーの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2 style="margin-bottom:30px">ユーザー一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-8">
                <form action="{{ action('Admin\AdminController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">ユーザー名</label>
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
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">プロフィール画像</th>
                                <th width="15%">ユーザー名</th>
                                <th width="45%">自己紹介</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th>{{ $user->user_id }}</th>

                                    <td class="image">
                                    {{--
                                    @if ($user->profile_image_path)
                                        <img style="width:100px;" src="{{ asset('storage/image/' . $user->profile_image_path) }}">
                                        @else
                                        <img style="width:100px;" src="{{ asset('storage/image/' . 'no-image2.png') }}">

                                    @endif
                                     --}}
                                    <img style="width:100px;" src="{{ Utl::getImagePath($user->profile_image_path) }}">
                                    </td>



                                    <td><a href="{{ action('Users\ProfileController@edit', ['id' => $user->user_id]) }}">{{ str_limit($user->name, 100) }}</a></td>
                                    <td>{{ str_limit($user->introduction, 250) }}</td>
                                    <td>

                                        <div>
                                            <a href="{{ action('Users\NewsController@index', ['id' => $user->id]) }}">詳細</a>
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
