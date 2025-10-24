@extends('layouts.layout')
@section('content')

<main>

    <form method="POST" action="{{ route('shop.create.submit') }}" enctype="multipart/form-data">

        @csrf

        <div>
            <label for="shop_img">店舗画像設定</label>
            <input id="shop_img" type="file" name="shop_img" value="{{ old('shop_img') }}" required autocomplete="shop_img" autofocus>
        </div>
        <div>
            <label for="shop_name">店舗名入力</label>
            <input id="shop_name" type="text" name="shop_name" value="{{ old('shop_name') }}" required autocomplete="shop_name" autofocus>
        </div>
        <div>
            <label for="address">店舗住所入力</label>
            <input id="address" type="text" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
        </div>
        <div>
            <label for="url">ホームページURL</label>
            <input id="url" type="text" name="url" value="{{ old('url') }}"  autocomplete="url" autofocus>
        </div>
        <div>
            <label for="tell">店舗電話番号</label>
            <input id="tell" type="text" name="tell" value="{{ old('tell') }}" autocomplete="tell" autofocus>
        </div>
        <div>
            <label for="station">最寄り駅</label>
            <input id="station" type="text" name="station" value="{{ old('station') }}" required autocomplete="station" autofocus>
        </div>

        <div>
            <p>お店のジャンル
                <input type="checkbox" name="karaoke" value="1">カラオケ
                <input type="checkbox" name="darts" value="1">ダーツ
                <input type="checkbox" name="bouling" value="1">ボーリング
                <input type="checkbox" name="billiards" value="1">ビリヤード
            </p>
        </div>

        <div>
            <button type="submit">
                店舗登録
            </button>
        </div>
    </form>
</main>   





@endsection