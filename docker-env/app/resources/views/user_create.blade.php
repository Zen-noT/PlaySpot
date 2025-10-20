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

            <a href="{{ route('user.login') }}">戻る</a>
        </header>

        <main>
            <h2>新規登録</h2>
            <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">

                @csrf
                <div>
                    <label for="name">ユーザーネーム</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                </div>
                <div>
                    <label for="email">メールアドレス</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>
                <div>
                    <label for="password">パスワード</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password">
                </div>
                <div>
                    <label for="icon_image">アイコン画像を設定</label>
                    <input id="icon_image" type="file" name="icon_image" value="{{ old('icon_image') }}" required autocomplete="icon_image" autofocus>
                </div>
                <div>
                    <label for="profile">プロフィール</label>
                    <textarea id="profile" name="profile"  autocomplete="profile" autofocus>{{ old('profile') }}</textarea>
                </div>
                <input type="hidden" name="role" value="1">

                <div>
                    <button type="submit">
                        新規登録
                    </button>
                </div>
            </form>    
    </body>
</html>