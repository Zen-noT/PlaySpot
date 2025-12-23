@extends('layouts.store_layout')
@section('content_store')

<main>

    <h2 class="text-center mt-4">承認待ち 店舗管理画面</h2>

    <div class="container mt-4 py-2">
        @if($shops->isEmpty())
            <p>該当するお店が見つかりませんでした。</p>
        @else
            <div class="row">
            @foreach($shops as $shop)
                <div class="card m-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="col-md-2">
                                    <img src="{{asset('storage/images/' . $shop->shop_img)}}" width="150" height="150" class="rounded">
                                </div>
                                <div class="col-md-4">
                                    <h2>{{ $shop->shop_name }}</h2>
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