@extends('layouts.layout')
@section('content')

<div>
    <div class="container mt-3 py-3">
        <div>
            <form action="{{route('shops.search')}}" method="GET" class="row mb-5 d-flex justify-content-center">
                @csrf
                <div class="col-md-3">
                    <label for="location">ロケーションを入力</label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>ジャンルを選択</label>
                    <select name="genre" id="genre" class="form-control">
                        <option value="">選択してください</option>
                        <option value="karaoke">カラオケ</option>
                        <option value="darts" >ダーツ</option>
                        <option value="bouling">ボウリング</option>
                        <option value="billiards">ビリヤード</option>
                        <option value="all">全部探す</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>混雑具合を選択</label>
                    <select name="congestion" id="congestion" class="form-control">
                        <option value="">選択してください</option>
                        <option value="0">空いているお店を検索</option>
                        <option value="1">少し並んでも探したい</option>
                        <option value="2">混んでいても探したい</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <br>
                    <button type="submit" class="btn btn-primary">検索</button>
                </div>
            </form>
        </div>
    </div>
    <!-- 検索結果ループでお店ごとに -->
    <div class="container mt-3 py-2">
        
        @if($shops->isEmpty())
            <p>該当するお店が見つかりませんでした。</p>
        @else
            <div class="row">
                @foreach($shops as $shop)
                    <div class=" col mb-5 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="d-flex align-items-center">
                                        <div class="col-md-2">
                                            <img src="{{asset('storage/images/' . $shop->shop_img)}}" width="120" height="120">
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{route('shops.detail',['shop'=> $shop->id ]) }}" >
                                                <h2>{{ $shop->shop_name }}</h2>
                                            </a>

                                            <p class='pt-3'>住所: {{ $shop->address }}</p>
                                        </div>
                                        <div class="col-md-3 d-flex justify-content-end">
                                            @if (!is_null($shop->evaluations_avg))
                                                <p>☆評価　:　 {{ number_format($shop->evaluations_avg, 1) }} 点</p>
                                            @else
                                                <p>評価なし</p>
                                            @endif
                                        </div>
                                        <div class="col-md-3  d-flex justify-content-end pr-5">
                                            @if ($shop->waiting_img === 0)
                                                <p>混雑状況　:　空いている</p>
                                            @elseif($shop->waiting_img === 1)
                                                <p>混雑状況　:　やや混雑</p>
                                            @elseif($shop->waiting_img === 2)
                                                <p>混雑状況　:　混雑</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        @endif
    
    </div>
</div>
























@endsection