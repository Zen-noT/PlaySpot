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

            <a href="{{ route('store.login') }}">戻る</a>
        </header>

        <main>
            <h2>パスワード変更完了</h2>
            <div>
                <p>パスワードの変更が完了しました</p>
                <p>新しいパスワードにて再ログインしてください</p>
            </div>
            <div>
                <a href="{{ route('store.login') }}">ログイン画面へ</a>
            </div>
        </main>

    </body>
</html>