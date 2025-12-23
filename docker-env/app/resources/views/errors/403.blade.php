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
        <header class="card navbar navbar-light bg-light mt-1 mb-3 sticky-top">
            <div class="container d-flex align-items-center">
                <div class="navbar-brand mb-0">
                    <img src="{{ asset('storage/images/PlaySpot_image.png') }}" alt="PlaySpot" width="80" height="80" />
                </div>
                
            </div>
        </header>

        <main class="m-5 text-center">
            <h2>アクセス権限がない為、アクセス出来ませんでした</h2>
            <p>もう一度やり直してください</p>

            
        </main>
    </body>
</html>
</html>