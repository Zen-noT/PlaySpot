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
        
        <header class="card navbar   mt-1  sticky-top">

            <div class="container justify-content-between">
                <a href="{{ route('user.search') }}" class="navbar-brand kurotai d-flex align-items-center">
                    <img src="{{ asset('storage/images/' .'PlaySpot_image.png') }}" alt="PlaySpot" width="50" height="50" />
                    <p class="mt-3 ms-2">待ち時間で検索できる　店舗検索サイト</p>
                </a>

                

                <div class="align-items-center"> 
                    @if(Auth::check())
                        <div class="d-flex align-items-center">
                            <img src="{{asset('storage/images/' . Auth::user()->icon )}}" width="40" height="40" class="rounded-circle me-2">
                            <span style="font-size: 1.7rem;" class="kuro mb-2">{{ Auth::user()->name }}</span>

                            <a href="{{ route('user.mypage') }}" class="px-2">
                            <img src="{{asset('storage/images/' . 'hanbarger-black.png' )}}" width="25" height="25" >

                            <a href="#" id="logout" class="kuro"> ログアウト</a>
                        </a>
                        </div>
                        
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