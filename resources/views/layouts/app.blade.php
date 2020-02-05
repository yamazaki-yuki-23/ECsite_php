<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ECsite</title>

    <!-- Scripts -->
    @if(app('env')=='local')
    <script src="{{ asset('js/app.js') }}" defer></script>
    @else
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
    @endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https:/fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @if(app('env')=='local')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @else
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    @endif

    <style>
    .errors {
        font-size: 12px;
        color: #e95353;
    }
    .title {
        font-family: 'Permanent Marker', cursive;
        font-size: 25px;
    }
    .complete {
        padding-left: 10px;
        width: 290px;
        font-size: 12px;
        color: #2a88bd;
        border: 1px solid #2a88bd;
        background-color: #a6e1ec;
    }
    .star-rating {
        position: relative;
        height: 1em;
        font-size: 15px;
    }
    .star-rating-front {
        position: absolute;
        top: 0;
        left: 0;
        overflow: hidden;
        color: #ffcc33;
    }
    .star-rating-back {
        color: #ccc;
    }
    .required {
        color:red;
        font-size:10px
    }
    .ellipsis {
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .login-border {
        display: flex;
        align-items: center;
    }
    .login-border:before, .login-border:after {
        content: "";
        flex-grow: 1;
        height: 1px; /* 線の太さを変えたいときはここを変える */
        background: #C0C0C0; /* 線の色を変えたいときはここを変える */
        margin:0 .4em; /* 文字と線の余白用 なくても良い */
    }
    #header-color {
        color:white;
    } 
    .navbar-toggler{
  border-color: #ffffff;
}
.navbar-toggler .navbar-toggler-icon {
  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255,255,255,1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
}
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand title" href="{{ url('/') }}" id="header-color">
                    ECsite
                </a>
                <form method="GET" action="/">
                    <input type="text" name="keyword">
                    <button type="submit" class="btn btn-primary btn-sm">商品検索</button>
                </form>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}" id="header-color">{{ __('ログイン') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}" id="header-color">{{ __('登録') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a href="/cartitem" class="nav-link" id="header-color">
                                    カート
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:white;">
                                    <span id="header-color">{{ Auth::user()->name }}</span> <span class="caret" id="header-color"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
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
            <div class="container">
                @if ($errors->any())
                    <span class="errors">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        <ul>
                    </span>
                @endif
                @yield('item-img')
            </div>
            @yield('content')
        </main>
    </div>
</body>
</html>
