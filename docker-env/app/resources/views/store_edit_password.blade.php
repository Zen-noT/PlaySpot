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
        <header>
            <!--ロゴ-->
        </header>

        <main>
            <h2>パスワード再設定</h2>
            <form method="POST" action="{{ route('store.update_password') }}">
                @csrf
                <div>
                    <label for="password">新パスワード入力</label>
                    <input id="password" type="password" name="password" value="" required autofocus>
                    <span>{{ $errors->first('password') }}</span>
                    <span>{{ $errors->first('reset_token') }}</span>
                </div>
                <div>
                    <label>新パスワード<span>確認</span></label>
                    <input type="password" name="password_confirmation" value="">
                </div>
                <div>
                    <button type="submit">
                        パスワードを再設定する。
                    </button>

                </div>
        </main>

    </body>
</html>