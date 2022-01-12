<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
    <!-- icon -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

    <!-- Lightbox2 画像ポップアップ -->
    <link rel="stylesheet" href="/css/lightbox.min.css">

    <style>
        a{color:white;}
        body {
            /* background-image: url('/image/scale_r.jpg');
            background-size:cover; */
            background-color: #ecefbc;
            color: white;
        }
        .bar-icon{
            color:#FFFFFF;
        }
        .card{
            background: white;
            border-radius:15px;
        }
        .alert{
            text-align: center;
            border-radius:15px;
        }
        .point_button {
            width: 50px;
            height: 50px;
            color: #ffffff;
            background-color: #6da9a0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
            border-radius: 50%;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #6da9a0;">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" style="background-color: #4d8980;" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto text-right">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="background-color: #770000;">
                                    <a class="dropdown-item text-white" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 mb-5">
            <div class="container">
                @yield('content')
            </div>
        </main>

        <div class="fixed-bottom">
            <div class="container py-2" style="border:solid; border-width: 1px 0 0 0; background-color: #6da9a0;">
                <div card="card" style="bar-dom border-radius:10px 10px 0 0;">
                    <div class="row text-center p-1">

                        <div class="col-3">
                            <a href="{{ route('top.top') }}">
                                <i class="bar-icon fa fa-2x fa-home" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('chat.chatlist') }}">
                                <i class="bar-icon fa fa-2x fa-comment" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('entry.show_entry_form') }}">
                                <i class="bar-icon fa fa-2x fa-sign-in" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('mypage.show_info') }}">
                                <i class="bar-icon fa fa-2x fa-user" aria-hidden="true"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- fixed-bottom -->


    </div>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>
    <!-- 画像ポップアップ -->
    <script type="text/javascript" src="/js/lightbox-plus-jquery.min.js"></script>

</body>
</html>
