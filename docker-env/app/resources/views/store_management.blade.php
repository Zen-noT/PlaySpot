@extends('layouts.store_layout')
@section('content_store')

<main>
    <div>
        <a href="{{route('shop.create')}}" class="btn btn-info ms-4 mt-4">
            新規店舗登録
        </a>
        <a href="{{route('store.delete')}}" class="btn btn-secondary ms-4 mt-4">
            店舗ユーザー消去
        </a>
    </div>

    <div class="container mt-4 py-2">
        @if($shops->isEmpty())
            <p>該当するお店が見つかりませんでした。</p>
        @else
            <div class="row">
            @foreach($shops as $shop)
                <div class=" col">
                    <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="d-flex align-items-center">

                                        <div class="col-md-2">
                                            <img src="{{asset('storage/images/' . $shop->shop_img)}}" width="150" height="150" class="rounded">
                                        </div>

                                        <div class="col-md-4">
                                            <h2>{{ $shop->shop_name }}</h2>

                                            <div>
                                                @if (!is_null($shop->evaluations_avg_evaluation))
                                                    <p>平均評価: {{ number_format($shop->evaluations_avg_evaluation, 1) }} 点</p>
                                                @else
                                                    <p>評価なし</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <form action="{{route('wait.time.submit')}}" method="GET"class="d-flex align-items-end " >
                                                @csrf
                                                <div class="m-2">
                                                    <label for="wait_img"class="form-label">待ち時間イメージ</label>
                                                    <select name="wait_img" id="wait_img" class="form-select form-select-sm">
                                                        <option value="0">空いている</option>
                                                        <option value="1">やや混んでいる</option>
                                                        <option value="2" >混雑している</option>
                                                    </select>
                                                </div>

                                                <div class="m-2">
                                                    <label for="wait_time"class="form-label small">予想待ち時間</label>
                                                    <input id="wait_time" type="text" name="wait_time" value="{{ old('wait_time') }}" 
                                                        class="form-control"
                                                        required autocomplete="wait_time">
                                                </div>

                                                <input id="shopId" name="shopId" type="hidden" value="{{ $shop->id }}">

                                                <div class="m-2">
                                                    <button type="submit" class="btn btn-info btn-sm ">更新</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            <div>
                                                <form action="{{route('shop.edit')}}" method="GET">
                                                    @csrf
                                                    <input id="shopId" name="shopId" type="hidden" value="{{ $shop->id }}">
                                                    <div>
                                                        <button type="submit" class="btn btn-info ms-5">店舗情報編集</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div>
                                                <form action="{{route('shop.delete')}}" method="GET">
                                                    @csrf
                                                    <input id="shopId" name="shopId" type="hidden" value="{{ $shop->id }}">
                                                    <div>
                                                        <button type="submit"  class="btn btn-secondary ms-5 mt-4">店舗消去</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        @endif
    </div>
</main>







@endsection