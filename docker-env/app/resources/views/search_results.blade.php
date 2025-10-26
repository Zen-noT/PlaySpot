@extends('layouts.layout')
@section('content')

<div>
    <form action="{{route('shops.search')}}" method="GET">
        @csrf
        <div>
            <label for="location">ロケーションを入力</label>
            <input type="text" name="location" id="location" value="{{ old('location') }}">
        </div>
        <div>
            <label>ジャンルを選択</label>
            <select name="genre" id="genre">
                <option value="">選択してください</option>
                <option value="karaoke">カラオケ</option>
                <option value="darts" >ダーツ</option>
                <option value="bouling">ボウリング</option>
                <option value="billiards">ビリヤード</option>
                <option value="all">全部探す</option>
            </select>
        </div>
        <div>
            <label>混雑具合を選択</label>
            <select name="congestion" id="congestion">
                <option value="">選択してください</option>
                <option value="0">空いているお店を検索</option>
                <option value="1">少し並んでも探したい</option>
                <option value="2">混んでいても探したい</option>
            </select>
        </div>
        <div>
            <button type="submit">検索</button>
        </div>
    </form>

    <!-- 検索結果ループでお店ごとに -->
    <div>
        @if($shops->isEmpty())
            <p>該当するお店が見つかりませんでした。</p>
        @else
            @foreach($shops as $shop)
                <div>
                    <div>
                        <img src="{{asset('storage/images/' . $shop->shop_img)}}" >
                    </div>

                    <a href="{{route('shops.detail',['shop'=> $shop->id ]) }}">
                        <h2>{{ $shop->shop_name }}</h2>
                    </a>

                    <p>住所: {{ $shop->address }}</p>

                    <div>
                        @if (!is_null($shop->evaluations_avg))
                            <p>平均評価: {{ number_format($shop->evaluations_avg, 1) }} 点</p>
                        @else
                            <p>評価なし</p>
                        @endif
                    </div>
                    <div>
                        @if ($shop->waiting_img === 0)
                            <p>空いている</p>
                        @elseif($shop->waiting_img === 1)
                            <p>やや混雑</p>
                        @elseif($shop->waiting_img === 2)
                            <p>混雑</p>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
























@endsection