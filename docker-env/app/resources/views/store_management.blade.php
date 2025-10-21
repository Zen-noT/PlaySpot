@extends('layouts.layout')
@section('content')

<main>
    <div>
        <a href="{{route('shop.create')}}">
            新規店舗登録
        </a>
        <a href="{{route('store.delete')}}">
            店舗ユーザー消去
        </a>
    </div>
    <div>
        @if($shops->isEmpty())
            <p>該当するお店が見つかりませんでした。</p>
        @else
            @foreach($shops as $shop)
                <div>
                    <div>
                        <div>
                            <img src="{{asset('storage/images/' . $shop->shop_img)}}" >
                        </div>

                        <h2>{{ $shop->shop_name }}</h2>

                        <div>
                            @if (!is_null($shop->evaluations_avg_evaluation))
                                <p>平均評価: {{ number_format($shop->evaluations_avg_evaluation, 1) }} 点</p>
                            @else
                                <p>評価なし</p>
                            @endif
                        </div>
                    </div>

                    <form action="{{route('wait.time.submit')}}" method="GET">
                        @csrf
                        <div>
                            <label>待ち時間イメージ</label>
                            <select name="wait_img" id="wait_img">
                                <option value="0">空いている</option>
                                <option value="1">やや混んでいる</option>
                                <option value="2" >混雑している</option>
                        </div>
                        <div>
                            <label for="wait_time">予想待ち時間</label>
                            <input id="wait_time" type="text" name="wait_time" value="{{ old('wait_time') }}" required autocomplete="wait_time" autofocus>
                        </div>

                        <input id="shopId" name="shopId" type="hidden" value="{{ $shop->id }}">

                        <div>
                            <button type="submit">更新</button>
                        </div>
                    </form>
                        
                    <div>
                        <form action="{{route('shop.edit')}}" method="GET">
                            @csrf
                            <input id="shopId" name="shopId" type="hidden" value="{{ $shop->id }}">
                            <div>
                                <button type="submit">店舗情報編集</button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <form action="{{route('shop.delete')}}" method="GET">
                            @csrf
                            <input id="shopId" name="shopId" type="hidden" value="{{ $shop->id }}">
                            <div>
                                <button type="submit">店舗消去</button>
                            </div>
                        </form>
                    </div>

                </div>
            @endforeach
        @endif
    </div>
</main>







@endsection