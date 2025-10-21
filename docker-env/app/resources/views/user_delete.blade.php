@extends('layouts.layout')
@section('content')

<main>

    <h3>本当にアカウントを消去してもよろしいですか？</h3>
    
    <form method="POST" action="{{ route('user.delete.submit') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <button type="submit">
                はい
            </button>
        </div>
    </form>

    <a href="{{ route('user.mypage') }}">
        戻る
    </a>    
    
</main>

























@endsection