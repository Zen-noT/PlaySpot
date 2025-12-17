@extends('layouts.admin_layout')
@section('content_admin')

<main>
    <div class="container mt-5 py-5">
        <div class="d-flex justify-content-center">
            <form method="POST" action="{{ route('admin.user.update.submit') }}" enctype="multipart/form-data" >
                @csrf
                <div class="d-flex justify-content-center align-items-center mb-5">
                    <img src="{{asset('storage/images/' . $user->icon )}}" width="200" height="200" class="rounded-circle">
                    <div class='mb-3 d-flex flex-column m-3'>
                        <label for="icon_image">アイコン画像を変更する</label>
                        <input id="icon_image" type="file" name="icon_image" value="{{ $user -> icon}}"  autocomplete="icon_image" autofocus>
                    </div>
                </div>
                <div class='mb-3 d-flex flex-column m-3'>
                    <label for="name">ユーザーネームを変更する</label>
                    <input id="name" type="text" name="name" value="{{$user -> name}}" required autocomplete="name" autofocus>
                </div>
                
                <div class='mb-3 d-flex flex-column m-3'>
                    <label for="profile">一言プロフィールを変更する</label>
                    <textarea id="profile" name="profile"  autocomplete="profile" autofocus>{{ $user -> profile }}</textarea>
                </div>

                <input type="hidden" name="userId" value="{{ $user->id }}">


                <div class='mt-5 d-flex justify-content-center'>
                    <button type="submit" class="btn btn-primary">
                        変更
                    </button>
                    <a href="{{ route('admin.user.management') }}" class="btn btn-secondary ms-3">
                        戻る
                    </a>
                </div>
            </form> 
        </div>   
    </div>
</main>

























@endsection