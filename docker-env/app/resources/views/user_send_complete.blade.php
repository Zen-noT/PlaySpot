<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <!-- 画面のサイズ設定 -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token　（セキュリティ） -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'larabel') }}</title>
        
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
         <!-- 読み込み高速化 -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <!-- グーグル提供のフォント -->
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- スタイルシート読み込み -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <header class="card navbar navbar-light bg-light mt-1 mb-3 sticky-top">
            <div class="container d-flex align-items-center">
                <div class="navbar-brand mb-0">
                    <img src="{{ asset('storage/images/PlaySpot_image.png') }}" alt="PlaySpot" width="80" height="80" />
                </div>
                <div class="ms-auto">
                    <a href="{{ route('user.login') }}" class="btn btn-secondary py-2 px-3">
                        戻る
                    </a>
                </div>
            </div>
        </header>

        <main>
            <div class="container mt-5 py-5">
                <div class="d-flex justify-content-center">
                    <div class='card'>
                        <div class="card-header">
                            <h2>メール送信完了</h2>
                        </div>
                        <div class="card-body">
                            <div class='mb-3 d-flex flex-column m-3'>
                                <p>パスワード再設定用のメールを送信しました</p>
                                <p>メールに記載されているリンクからパスワードの再設定を行ってください</p>
                            </div>
                            <div class='mb-3 d-flex flex-column m-3'>
                                <a href="{{ route('user.login') }}" class="btn btn-primary">ログイン画面へ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </body>
</html>