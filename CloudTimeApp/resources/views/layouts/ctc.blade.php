<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- アプリアイコン -->
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('image/ctc_app_icon.png')}}" sizes="180x180">
    <link rel="icon" type="image/png" href="{{ asset('image/ctc_app_icon.png')}}" sizes="192x192">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="dedault">

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
                <div class="navbar-brand text-white">
                    {{ config('app.name', 'Laravel') }}
                    <i class="fa fa-question-circle" data-toggle="modal" aria-hidden="true" data-target="#modalHelp"></i>
                </div>
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="{{ route('mypage.show_info') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <a class="dropdown-item text-white" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

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

    <!-- ヘルプポップアップ -->
    <div class="modal fade right" id="modalHelp" tabindex="-1" role="dialog" aria-labelledby="modalHelpLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalHelpLabel" style="color:black;">説明書</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding:40px;">
                    <h4 class="pb-5" style="color:black;">これから思い出を作る君へ
                    <h6 class="pb-5" style="color:black;">手順① カプセルを新しく作ろう！<br><br>
                    <a href="/image/home2.png" data-lightbox="group"><img src="/image/home2.png" height="300"/></a><br>
                    ホーム画面の右下にある＋ボタンをタップ！<br><br>
                    <a href="/image/new_capsule.png" data-lightbox="group"><img src="/image/new_capsule.png" height="300"/></a><br>
                    新規作成に必要な情報を入力して作成しよう！<br>作成するとホーム画面に追加されるよ！<br><br>
                    <a href="/image/home3.png" data-lightbox="group"><img src="/image/home3.png" height="300"/></a><br>
                    <h6 class="pb-5" style="color:black;">手順② 思い出を追加しよう！<br><br>
                    さっそく思い出を追加していくよ！<br>
                    さっき作ったカプセルの中にある”思い出を追加”ってボタンをタップしてみて！<br><br>
                    <a href="/image/capsule_omoide.png" data-lightbox="group"><img src="/image/capsule_omoide.png" height="300"/></a><br>
                    写真か手紙を選んでタイトルと追加したい写真か本文を入力して<br>アップロードボタンを押してね！<br><br>
                    <a href="/image/photo_add.png" data-lightbox="group"><img src="/image/photo_add.png" height="300"/></a><br>
                    アップロードボタンを押した時点でカプセルに追加されるよ！<br>
                    開封日を過ぎると”思い出追加ボタン”が<br>”開封ボタン”に変わるよ！<br><br>
                    一度追加した画像は開封日になるまで見れないから楽しみにしててね！<br>
                    <h6 class="pb-5" style="color:black;">手順③ メンバーを招待しよう！<br><br>
                    友達に招待コードを入力してもらうことで自分の作ったカプセルに<br>
                    参加してもらうことができるよ！<br><br>
                    <a href="/image/capsule_entry.png" data-lightbox="group"><img src="/image/capsule_entry.png" height="300"/></a><br><br>
                    エントリーコード入力はこんな画面だよ！<br><br>
                    <a href="/image/entry_code.png" data-lightbox="group"><img src="/image/entry_code.png" height="300"/></a><br><br>
                    教えてもらった招待コードを入力して、同じものがあったら表示されるよ！<br><br>
                    <a href="/image/entry_code2.png" data-lightbox="group"><img src="/image/entry_code2.png" height="300"/></a><br><br>
                    もし招待コードが間違ってたり、既に参加してたら表示されないから気をつけてね！<br>
                    表示されたカプセルをタップすると参加が完了するよ！！<br>
                    <h6 class="pb-5" style="color:black;">番外編 チャットをしよう！<br><br>
                    このアプリケーション内でグループチャットをすることができるよ！<br>
                    カプセルの中にあるここをタップしてみて！<br>
                    <a href="/image/capsule_chat.png" data-lightbox="group"><img src="/image/capsule_chat.png" height="300"/></a><br><br>
                    <!-- 三浦待ち -->

                    説明は以上だよ！<br>たくさん思い出を追加してね！！
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block waves-effect" data-dismiss="modal" style="border-radius:15px;">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ヘルプポップアップ- -->

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
