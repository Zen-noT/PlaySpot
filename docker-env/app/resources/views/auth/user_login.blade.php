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

            <a href="{{ url('/store_login') }}">企業ユーザログインはこちら</a>
        </header>

        <main>
            <h2>ログイン</h2>
            <form method="POST" action="{{ route('user.login') }}">
                @csrf
                <div>
                    <label for="email">メールアドレス</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>

                <div>
                    <label for="password">パスワード</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password">
                </div>

                <div>
                    <button type="submit">
                        ログイン
                    </button>

                    <a href="{{ route('user.create') }}">会員登録はこちら</a>
                    <a href="{{ route('user.reset') }}">パスワードを忘れた場合はこちら</a>

                </div>
        </main>

    </body>
</html>