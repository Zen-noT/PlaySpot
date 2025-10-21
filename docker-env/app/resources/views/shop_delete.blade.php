@extends('layouts.layout')
@section('content')

<main>

    <h3>この店舗を消去してもよろしいですか？</h3>
    
    <form method="POST" action="{{ route('shop.delete.submit') }}" enctype="multipart/form-data">
        @csrf
        <input id="shopId" name="shopId" type="hidden" value="{{ $shopId }}">
        <div>
            <button type="submit">
                はい
            </button>
        </div>
    </form>

    <a href="{{ route('store.management') }}">
        戻る
    </a>    
    
</main>


@endsection