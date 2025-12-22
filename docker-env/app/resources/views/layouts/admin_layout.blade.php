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
        
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <!-- 読み込み高速化 -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <!-- グーグル提供のフォント -->
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- スタイルシート読み込み -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        
        <header class="card navbar  navbar-light bg-light mt-1 mb-3 sticky-top">
            <div class="container justify-content-between ">
                <div class="navbar-brand ">
                    <a href="{{ route('admin.home') }}">
                        <img src="{{ asset('storage/images/' .'PlaySpot_image.png') }}" alt="PlaySpot" width="80" height="80" />
                    </a>
                </div>
                <div class="align-items-center">
                    @if (Auth::guard('admin')->check())

                        <span style="font-size: 1.7rem;" class="m-2">管理者：{{ Auth::guard('admin')->user()->name }} ログイン中</span>


                        <a href="#" id="logout" class="btn btn-dark me-0 mb-2" > ログアウト</a>

                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
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

        @yield('content_admin')
            
            
       
    </body>
</html>