@extends('layouts.layout')
@section('content')

<main>
    <div>
        <img src="{{asset('storage/images/' . Auth::user()->icon )}}" width="100" height="100">
    </div>
    <div>
        <span>{{ Auth::user()->name }}</span>
        <p>{{ Auth::user()->profile }}</p>
    </div>
    <div>
        <a href="{{ route('user.update') }}">
            ユーザー情報を編集
        </a>
        <a href="{{ route('user.deleate') }}">
            アカウントを消去
        </a>
        
    </div>
</main>

























@endsection