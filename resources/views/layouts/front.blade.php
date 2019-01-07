<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/front.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  </head>
  <body>
    <div id="app">
      <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}">
           {{ config('app.name'),'Laravel' }}
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav ml-auto">
                                      <!-- Authentication Links -->
                                      {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                        @guest
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a></li>
                                                        @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                                </li>
                            @endif
                        {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

 <div id="dropdown" class="dropdown-menu" aria-labelledby="navbarDropdown">
      @if(( Auth::user()->id ) === 9 )
 <a class="dropdown-item" href="{{ url('/admin') }}">{{ __('ユーザー一覧') }}</a>
     @endif
 <a class="dropdown-item" href="{{ url('users/news') }}?id={{Auth::user()->id}}">{{ __('投稿') }}</a>
 <a class="dropdown-item" href="{{ url('users/profile/edit')}}?id={{Auth::user()->id}}">{{ __('登録情報変更') }}</a>
 <a class="dropdown-item" href="{{ route('logout') }}"
     onclick="event.preventDefault();
     document.getElementById('logout-form').submit();">
     {{ __('Logout') }}
  </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
            </ul>
          </div>
        </div>
      </nav>
      <main class="py-4">
        @yield('content')
      </main>
    </div>
  </body>
</html>
