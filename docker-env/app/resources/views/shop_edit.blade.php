@extends('layouts.layout')
@section('content')

<main>

    <form method="POST" action="{{ route('shop.edit.submit') }}" enctype="multipart/form-data">

        @csrf

        <div>
            @if($shop->shop_img)
                <div>
                    <img src="{{ asset('storage/images/'.$shop->shop_img) }}" alt="現在の画像" width="150">
                </div>
            @endif
            <label for="shop_img">店舗画像変更</label>
            <input id="shop_img" type="file" name="shop_img" value="{{ old('shop_img') }}" autocomplete="shop_img" autofocus>
        </div>
        <div>
            <label for="shop_name">店舗名入力</label>
            <input id="shop_name" type="text" name="shop_name" value="{{ old('shop_name', $shop->shop_name) }}" required autocomplete="shop_name" autofocus>
        </div>
        <div>
            <label for="address">店舗住所入力</label>
            <input id="address" type="text" name="address" value="{{ old('address', $shop->address) }}" required autocomplete="address" autofocus>
        </div>
        <div>
            <label for="url">ホームページURL</label>
            <input id="url" type="text" name="url" value="{{ old('url', $shop->url) }}"  autocomplete="url" autofocus>
        </div>
        <div>
            <label for="tell">店舗電話番号</label>
            <input id="tell" type="text" name="tell" value="{{ old('tell', $shop->tell)  }}" autocomplete="tell" autofocus>
        </div>
        <div>
            <label for="station">最寄り駅</label>
            <input id="station" type="text" name="station" value="{{ old('station', $shop->station) }}" required autocomplete="station" autofocus>
        </div>

        <div>
            <p>お店のジャンル
                <label>
                <input type="checkbox" name="karaoke" value="1" {{ old('karaoke', $genre->karaoke) ? 'checked' : '' }}> カラオケ
                </label>
                <label>
                <input type="checkbox" name="darts" value="1" {{ old('darts', $genre->darts) ? 'checked' : '' }}> ダーツ
                </label>
                <label>
                <input type="checkbox" name="bouling" value="1" {{ old('bouling', $genre->bouling) ? 'checked' : '' }}> ボーリング
                </label>
                <label>
                <input type="checkbox" name="billiards" value="1" {{ old('billiards', $genre->billiards) ? 'checked' : '' }}> ビリヤード
                </label>
                
            </p>
        </div>

        <input id="shopId" name="shopId" type="hidden" value="{{ $shopId }}">

        <div>
            <button type="submit">
                店舗編集
            </button>
        </div>
    </form>
</main>   





@endsection