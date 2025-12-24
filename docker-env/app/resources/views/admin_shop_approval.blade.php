@extends('layouts.admin_layout')
@section('content_admin')

<main>
    <div class="d-flex justify-content-between align-items-center">
        <h2>店舗承認待ち画面</h2>
        <a href="{{ route('admin.store.management') }}" class="btn btn-secondary mb-3 me-2">
            店舗管理画面へ移動
        </a>
    </div>

    <div class="container mt-5 py-2">
        @if($stores->isEmpty())
            <p>該当する店舗が見つかりませんでした。</p>
        @else
            <div class="row flex-column">
            @foreach($stores as $store)
                <div class="col-12 mb-3">
                    <div class="card p-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center" style="min-width: 0;">
                                
                                <div class="me-3">
                                    <img src="{{asset('storage/images/' . $store->shop_img)}}" 
                                         width="70" height="70" class="rounded-circle">
                                </div>

                                <div style="min-width: 0;">
                                    <a href="{{ route('admin.shop.detail',['shopId' => $store->id]) }}">
                                        <h4 class="mb-1">{{ $store->shop_name }}</h4>
                                </a>
                                    <p class="mb-0">店舗ID: {{ $store->id }}</p>
                                    <p class="mb-0">ユーザーID: {{ $store->user_id }}</p>

                                    <p class="mb-0 text-truncate" style="max-width: 600px;">
                                        住所: {{ $store->address }}
                                    </p>

                                    <p class="mb-0">登録日: {{ $store->created_at }}</p>
                                </div>
                            </div>

                            <div>
                                <form action="{{route('admin.store.approve.form')}}" method="POST" class="mb-2">
                                    @csrf
                                    <input type="hidden" name="storeId" value="{{ $store->id }}">
                                    <button type="submit" class="btn btn-info">店舗承認</button>
                                </form>
                                <form action="{{route('admin.store.deleate.form')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="storeId" value="{{ $store->id }}">
                                    <button type="submit" class="btn btn-danger">店舗消去</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
            </div>
            @if(method_exists($stores,'links'))
                <div class="d-flex justify-content-center mt-4">
                    {{ $stores->appends(request()->query())->links() }}
                </div>
            @endif
        @endif
    </div>
</main>

@endsection