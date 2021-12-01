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

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
    <!-- icon -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

    <style>
        a{color:black}
        body {
            background: white;
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
            background-color: #2779ff;
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
        <nav class="navbar navbar-expand-md fixed-top navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- 戻るボタン_要処理 -->
                @yield('back_button')
                <div class="text-center">
                    @yield('nav_title')
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <div>{{ config('app.name', 'Laravel') }} BETA</div>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}(id:{{ Auth::user()->id }})
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 my-5">
            <div class="container">
            @yield('content')
            </div>
        </main>

        <div class="fixed-bottom">
            <div class="container">
                <div card="card" style="border-radius:10px 10px 0; border:solid; background-color:white;">
                    <div class="row text-center p-1">

                        <div class="col-3">
                            <a href="{{ route('top.top') }}">
                                <i class="fa fa-2x fa-home" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col-3">
                            <a href="">
                                <i class="fa fa-2x fa-comment" aria-hidden="true" style="color:#AAAAAA;"></i>
                            </a>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('entry.show_entry_form') }}">
                                <i class="fa fa-2x fa-sign-in" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('mypage.show_info') }}">
                                <i class="fa fa-2x fa-user" aria-hidden="true"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- fixed-bottom -->
        

    </div>

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>
        @yield("script")
</body>
</html>
