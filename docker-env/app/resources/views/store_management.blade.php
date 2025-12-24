@extends('layouts.store_layout')
@section('content_store')

<main>
    <div style="text-align: right;">
        <a href="{{route('shop.create')}}" class="btn btn-secondary ms-4 mt-4">
            新規店舗登録申請
        </a>
        <a href="{{route('store.delete')}}" class="btn btn-danger ms-4 mt-4">
            店舗ユーザー消去
        </a>
        <a href="{{route('shop.approval')}}" class="btn btn-warning ms-4 mt-4 me-3">
            承認待ち 店舗管理画面
        </a>
    </div>

    <h2 class="text-center mt-4">店舗管理画面</h2>

    <div class="container mt-4 py-2">
        @if($shops->isEmpty())
            <p>該当するお店が見つかりませんでした。</p>
        @else
            <div class="row">
            @foreach($shops as $shop)
                <div class="card m-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex align-items-center">
                                <div class="col-md-2">
                                    <img src="{{asset('storage/images/' . $shop->shop_img)}}" width="150" height="150" class="rounded">
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('store.shop.detail',['shopId' => $shop->id]) }}">
                                        <h2>{{ $shop->shop_name }}</h2>
                                    </a>
                                    <div>
                                        @if (!is_null($shop->evaluations_avg_evaluation))
                                            <p>平均評価: {{ number_format($shop->evaluations_avg_evaluation, 1) }} 点</p>
                                        @else
                                            <p>評価なし</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div>
                                        <form action="{{route('wait.time.submit')}}" method="POST"class="d-flex align-items-end " >
                                            @csrf
                                            <div class="m-2">
                                                <label for="wait_img"class="form-label">混雑状況</label>
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
                                                    required autocomplete="wait_time" placeholder="分単位で登録してください">
                                            </div>

                                            <input id="shopId" name="shopId" type="hidden" value="{{ $shop->id }}">

                                            <div class="m-2">
                                                <button type="submit" class="btn btn-info btn-m ">更新</button>
                                            </div>
                                        </form>
                                        <div class="mt-4 d-flex">
                                            @if ($shop->waiting_img === 0)
                                                <h6>・ 登録中の混雑状況 : 空いている</h6>
                                            @elseif($shop->waiting_img === 1)
                                                <h6>・ 登録中の混雑状況 : やや混雑</h6>
                                            @elseif($shop->waiting_img === 2)
                                                <h6>・ 登録中の混雑状況 : 混雑</h6>
                                            @endif

                                            <h6 class='ms-3'>・ 登録中の待ち時間 : {{ $shop->waiting_time }} 分</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div>
                                        <form action="{{route('shop.edit')}}" method="GET">
                                            @csrf
                                            <input id="shopId" name="shopId" type="hidden" value="{{ $shop->id }}">
                                            <div>
                                                <button type="submit" class="btn btn-info ms-5">店舗編集</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div>
                                        <form action="{{route('shop.delete')}}" method="GET">
                                            @csrf
                                            <input id="shopId" name="shopId" type="hidden" value="{{ $shop->id }}">
                                            <div>
                                                <button type="submit"  class="btn btn-danger ms-5 mt-4">店舗消去</button>
                                            </div>
                                        </form>
                                    </div>
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
</main>







@endsection