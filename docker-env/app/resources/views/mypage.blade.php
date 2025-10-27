@extends('layouts.layout')
@section('content')

<main >
    <div class="container mt-5 py-5">
        <div class="row mb-5 d-flex justify-content-center">
            <div class="col-md-3">
                <img src="{{asset('storage/images/' . Auth::user()->icon )}}" width="200" height="200" class="rounded-circle">
            </div>
            <div class="col-md-3 mt-4">
                <h2>{{ Auth::user()->name }}</h2>
                <div class="mt-5">
                    <p>一言プロフィール</p>
                    <div class="card p-2">
                        <p>{{ Auth::user()->profile }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 py-4" >
                <a href="{{ route('user.update') }}" class="d-block btn btn-info ms-5 mt-5">
                    ユーザー情報を編集
                </a>
                <a href="{{ route('user.delete') }}" class="d-block btn btn-secondary ms-5 mt-4">
                    アカウントを消去
                </a>
                
            </div>
        </div>
    </div>
</main>

























@endsection