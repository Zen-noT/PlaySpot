@extends('layouts.admin_layout')
@section('content_admin')

<main>
    <div class="container mt-5 py-5">
        <div class="d-flex justify-content-center">
            <form method="POST" action="{{ route('admin.store.user.update.submit') }}" enctype="multipart/form-data" >
                @csrf
                
                <div class='mb-3 d-flex flex-column m-3'>
                    <label for="name">ユーザーネームを変更する</label>
                    <input id="name" type="text" name="name" value="{{$user -> name}}" required autocomplete="name" autofocus>
                </div>
                
                

                <input type="hidden" name="userId" value="{{ $user->id }}">


                <div class='mt-5 d-flex justify-content-center'>
                    <button type="submit" class="btn btn-primary">
                        変更
                    </button>
                    <a href="{{ route('admin.store.user.management') }}" class="btn btn-secondary ms-3">
                        戻る
                    </a>
                </div>
            </form> 
        </div>   
    </div>
</main>

























@endsection