@extends('layouts.front')

@section('content')
  <div class="container profile-index">
    <hr color="#c0c0c0">
    @if (!is_null($headline))
      <div class="row">
        <div class="headline col-md-10 mx-auto">
          <div class="row">
            <div class="col-md-6">
              <div class="caption mx-auto">
                <figure class="image profile-image">
                  {{--　松田変更ここから --}}
                  {{--
                    @if ($headline->profile_image_path)
                    <img src="{{ asset('storage/image/' . $headline->profile_image_path) }}">
                    @else
                    <img src="{{ asset('storage/image/' . 'no-image2.png') }}">

                    @endif
                  --}}
                  <img src="{{ Utl::getProfileImagePath($headline->profile_image_path) }}">
                  {{--　松田変更ここまで --}}
                </figure>
              </div>
            </div>
            <div class="col-md-6 profile-body">
              <p class="body mx-auto">ユーザー名<br>{{ str_limit($headline->name, 50) }}</p>
              <!-- <p class="body mx-auto">Gender<br>{{ str_limit($headline->gender,10) }}</p> -->
              <p class="body mx-auto">趣味<br>{{ str_limit($headline->hobby, 200) }}</p>
              <p class="body mx-auto">自己紹介<br>{{ str_limit($headline->introduction, 400) }}</p>
            </div>
          </div>
        </div>
      </div>
      @endif
      <hr color="#c0c0c0">
      <div class="row">
        <div class="posts col-md-8 mx-auto mt-3">
          @foreach($posts as $post)
              @if( ( $post->user_id ) == ( $user_id_for_show ) )
            <article class="post">
              <div class="row">
                <div class="text col-md-6">
                  <p class="date">
                      {{ $post->updated_at->format('Y年m月d日') }}
                  </p>
                  <h1 class="title">
                      {{ str_limit($post->title, 60) }}
                  </h1>
                  <!-- <div class="auther">
                      {{ $post->user->name }}
                  </div> -->
                  <p class="body mt-3">
                      {{ str_limit($post->body, 230) }}
                  </p>
                  <p class="more"><a href="{{ action('NewsController@show', ['id' => $post->id]) }}">もっと見る</a></p>
                  </div>
                  <figure class="image col-md-6 text-right mt-4">
                  {{--　松田変更ここから --}}
                  {{--
                  @if ($post->image_path)
                    <img src="{{ asset('storage/image/' . $post->image_path) }}">
                    @else
                    <img src="{{ asset('storage/image/' . 'no-image.png') }}">

                  @endif
                  --}}
                  <img src="{{ Utl::getImagePath($post->image_path) }}">
                  {{--　松田変更ここまで --}}
                  </figure>
              </div>
            </article>
          <hr color="#c0c0c0">
          @endif
        @endforeach
      </div>
    </div>
  </div>
  </div>
@endsection
