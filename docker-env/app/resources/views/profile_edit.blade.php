@extends('layouts.layout')
@section('content')

<main>
    <div class="container mt-5 py-5">
        <div class="d-flex justify-content-center">
            <form method="POST" action="{{ route('user.update.submit') }}" enctype="multipart/form-data" >
                @csrf
                <div class="d-flex justify-content-center align-items-center mb-5">
                    <img src="{{asset('storage/images/' . Auth::user()->icon )}}" width="200" height="200" class="rounded-circle">
                    <div class='mb-3 d-flex flex-column m-3'>
                        <label for="icon_image">アイコン画像を変更する</label>
                        <input id="icon_image" type="file" name="icon_image" value="{{ old('icon_image') }}" required autocomplete="icon_image" autofocus>
                    </div>
                </div>
                <div class='mb-3 d-flex flex-column m-3'>
                    <label for="name">ユーザーネームを変更する</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                </div>
                <div class='mb-3 d-flex flex-column m-3'>
                    <label for="email">メールアドレスを変更する</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>
                <div class='mb-3 d-flex flex-column m-3'>
                    <label for="password">パスワードを変更する</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password">
                </div>
                <div class='mb-3 d-flex flex-column m-3'>
                    <label for="profile">一言プロフィールを変更する</label>
                    <textarea id="profile" name="profile"  autocomplete="profile" autofocus>{{ old('profile') }}</textarea>
                </div>


                <div class='mt-5 d-flex justify-content-center'>
                    <button type="submit" class="btn btn-primary">
                        変更
                    </button>
                </div>
            </form> 
        </div>   
    </div>
</main>

























@endsection