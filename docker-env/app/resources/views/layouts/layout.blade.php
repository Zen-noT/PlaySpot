<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <!-- 画面のサイズ設定 -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token　（セキュリティ） -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'larabel') }}</title>

        <!-- jQuery読み込み -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        
        <!-- 読み込み高速化 -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <!-- グーグル提供のフォント -->
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- スタイルシート読み込み -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <!-- splidejs　読み込み　-->
        <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    </head>
    <body>
        
        <header class="card navbar  navbar-light bg-light mt-1  sticky-top">
            <div class="container justify-content-between ">
                <div class="navbar-brand ">
                    <a href="{{ route('user.search') }}">
                        <img src="{{ asset('storage/images/' .'PlaySpot_image.png') }}" alt="PlaySpot" width="80" height="80" />
                    </a>
                </div>
                <div class="align-items-center"> 
                    @if(Auth::check())
                        <span style="font-size: 1.7rem;">{{ Auth::user()->name }}</span>

                        <a href="{{ route('user.mypage') }}" class="px-2">
                            <img src="{{asset('storage/images/' . Auth::user()->icon )}}" width="80" height="80" class="rounded-circle">
                        </a>
                        

                        <a href="#" id="logout" class="btn btn-dark"> ログアウト</a>
                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <script>
                            document.getElementById('logout').addEventListener('click', function(event) {
                                event.preventDefault();
                                document.getElementById('logout-form').submit();
                            });
                        </script>
                    @endif
                </div>
            </div>    
        </header>

         <!-- バリデーションエラーの表示 -->
        <div class='panel-body'>
            @if($errors->any())
            <div class='alert alert-danger'>
                <ul>
                    @foreach($errors->all() as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>

            </div>
            @endif
        </div>

        @yield('content')
            
            
       <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
        <script src="{{ mix('js/app.js') }}"></script>

        
    </body>
</html>