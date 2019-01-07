@extends('layouts.front')

@section('content')
  <div class="container single">
    <hr color="#c0c0c0">
    <h1 class="inner">{{ $post->title }}</h1>
    <hr color="#c0c0c0">
    <div class="inner">
 <p class="date"><span class="created_at">{{ $post->created_at->format('Y年m月d日') }}</span><i class="fas fa-redo-alt"></i><span class="updated_at">{{ $post->updated_at->format('Y年m月d日') }}</span></p>
    <p class="auther">
    <a href="{{ action('ProfileController@show', ['id' => $post->user_id]) }}">{{ $post->user->name }}</a>
</p>
    <figure style="margin:10px 0 40px;" >
    @if ($post->image_path)
      {{--松田変更ここから--}}
      {{--<img style="width:100%; height:auto;" src="{{ asset('storage/image/' . $post->image_path) }}">--}}
      <img style="width:100%; height:auto;" src="{{ Utl::getImagePath($post->image_path) }}">
      {{--松田変更ここまで--}}
    @endif
</figure>
    <p class="body" style="line-height:1.7;">{!! nl2br(e($post->body)) !!}</p>
    </div>

  </div>
@endsection
