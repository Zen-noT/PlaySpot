@extends('layouts.layout')
@section('content')

<div>
    
    <div class="d-flex" style="width: 90%;">
        
        <div class="container sidebar" style="width: 18%; ">
            <div class="card ">
                <div class="card-body">
                    <form action="{{route('shops.search')}}" method="GET" class="row ">
                        @csrf
                        <div>
                            <label for="location" class="mt-1">地域を入力</label>
                            <input type="text" name="location" id="location" value="{{ old('location') }}" class="form-control" placeholder="指定なし">
                        </div>
                        <div>
                            <label for="genre" class="mt-2">ジャンルを選択</label>
                            <select name="genre" id="genre" class="form-control mt-1">
                                <option value="">指定なし</option>
                                <option value="karaoke">カラオケ</option>
                                <option value="darts" >ダーツ</option>
                                <option value="bouling">ボウリング</option>
                                <option value="billiards">ビリヤード</option>
                                <option value="all">全部探す</option>
                            </select>
                        </div>
                        <div>
                            <label for="congestion"class="mt-2">混雑具合を選択</label>
                            <select name="congestion" id="congestion" class="form-control mt-1">
                                <option value="">指定なし</option>
                                <option value="0">空いているお店を検索</option>
                                <option value="1">少し並んでも探したい</option>
                                <option value="2">混んでいても探したい</option>
                            </select>
                        </div>
                        <div class="mt-3 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">検索</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- 検索結果ループでお店ごとに -->
        <div class="container content " style="width: 72%; ">
            @if($shops->isEmpty())
                <p>該当するお店が見つかりませんでした。</p>
            @else
                @foreach($shops as $shop)  
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="d-flex align-items-center">
                                    <div class="col-md-2">
                                        <img src="{{asset('storage/images/' . $shop->shop_img)}}" width="150" height="150">
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
                @endforeach

                @if(method_exists($shops,'links'))
                <div class="d-flex justify-content-center mt-4">
                    {{ $shops->appends(request()->query())->links() }}
                </div>
                @endif

            @endif
        
        </div>
    </div>
</div>
























@endsection