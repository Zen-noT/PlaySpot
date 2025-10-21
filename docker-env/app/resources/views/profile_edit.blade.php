@extends('layouts.layout')
@section('content')

<main>
    
    <form method="POST" action="{{ route('user.update.submit') }}" enctype="multipart/form-data">

        @csrf

        <div>
            <img src="{{asset('storage/images/' . Auth::user()->icon )}}" width="150" height="150">
            <label for="icon_image">アイコン画像を変更する</label>
            <input id="icon_image" type="file" name="icon_image" value="{{ old('icon_image') }}" required autocomplete="icon_image" autofocus>
        </div>
        <div>
            <label for="name">ユーザーネームを変更する</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        </div>
        <div>
            <label for="email">メールアドレスを変更する</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>
        <div>
            <label for="password">パスワードを変更する</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
        </div>
        <div>
            <label for="profile">一言プロフィールを変更する</label>
            <textarea id="profile" name="profile"  autocomplete="profile" autofocus>{{ old('profile') }}</textarea>
        </div>


        <div>
            <button type="submit">
                変更
            </button>
        </div>
    </form>    
</main>

























@endsection