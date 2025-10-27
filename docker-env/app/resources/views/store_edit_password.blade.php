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
            </div>
        </header>

        <main>
            <div class="container mt-5 py-5">
                <div class="d-flex justify-content-center">
                    <div class='card'>
                        <div class="card-header">
                            <h2>パスワード再設定</h2>
                        </div>
                        <form method="POST" action="{{ route('store.update_password') }}" class="card-body">
                            @csrf
                            <div class='mb-3 d-flex flex-column m-3'>
                                <label for="password">新パスワード入力</label>
                                <input id="password" type="password" name="password" value="" required autofocus>
                                <span>{{ $errors->first('password') }}</span>
                                <span>{{ $errors->first('reset_token') }}</span>
                            </div>
                            <div class='mb-3 d-flex flex-column m-3'>
                                <label>新パスワード<span>確認</span></label>
                                <input type="password" name="password_confirmation" value="">
                            </div>
                            <div class='mb-3 d-flex flex-column m-3'>
                                <button type="submit" class="btn btn-primary">
                                    パスワードを再設定する。
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

    </body>
</html>