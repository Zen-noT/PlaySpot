@extends('layouts.store_layout')
@section('content_store')
<main>
    <div class="container mt-3">
        <!-- 店舗情報 -->
        <div class="row mb-3 pt-3"> 
            <h2 class="mb-1">{{ $shop->shop_name }}</h2>

            <div class="d-flex mt-2">
                @if (!is_null($avg))
                    <h5>☆評価 : {{ number_format($avg, 1) }} 点</h5>
                @else
                    <h5>☆評価 : 評価なし</h5>
                @endif

                <h5 class='ms-4'>予想待ち時間：{{ $waitingtime->waiting_time }}分</h5>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-12 col-lg-8 mt-5 mb-4">
                <!-- 店舗画像-->
                <img src="{{asset('storage/images/' . $shop->shop_img)}}" width="100%" height="500" alt="店舗画像">

                <!-- 店舗詳細情報-->
                <div class="mt-5">
                    <div class="card-body mb-5" style="width:100%;">
                        <table class="table table-bordered">
                            <tr><td>電話番号: {{ $shop->tell }}</td></tr>
                            <tr><td>公式サイト: <a href="{{ $shop->url }}" target="_blank" rel="noopener noreferrer">{{ $shop->url }}</a></td></tr>
                            <tr><td>最寄り駅：{{$shop -> station}}</td></tr>

                            <tr><td>
                                <p>住所: {{ $shop->address }}</p>
                                <iframe id='map' src='https://www.google.com/maps/embed/v1/place?key={{ config("services.google-map.apikey") }}&q={{ $shop->address }}'
                                    width='100%' height='200' frameborder='0' class='mt-3' >
                                </iframe>
                            </td></tr>
                        </table>
                    </div>
                </div>

                
            </div>

            <!-- review-->
            <div class="col-md-12 col-lg-4">
                <div class="card-body">
                    <div class="review_list">

                        <div class="card-body">
                            <h3>レビュー一覧</h3>
                        </div>
                        @if($evaluations->isEmpty())
                            <p>まだレビューがありません。</p>
                        @else
                            @foreach($evaluations as $evaluation)
                                <div class="card mt-3 p-3">
                                    <div class="d-flex align-items-center mb-2">
                                        @if($evaluation->icon)
                                            <div>
                                                <img src="{{asset('storage/images/' . $evaluation->icon)}}" width="40" height="40" class="rounded-circle">
                                            </div>
                                        @else
                                            <div>
                                                <img src="{{asset('storage/images/NoImage.jpg')}}" width="40" height="40" class="rounded-circle">
                                            </div>
                                        @endif
                                        <p class='ms-3 mt-3'>投稿者: {{ $evaluation->user->name }}</p>
                                    </div>

                                    <p>評価: {{ $evaluation->evaluation }} 点</p>
                                    <p>コメント: {{ $evaluation->comment }}</p>
                                    
                                    <p>投稿日: {{ $evaluation->created_at->format('Y-m-d') }}</p>
                                </div>
                            @endforeach
                            @if(method_exists($evaluations,'links'))
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $evaluations->appends(request()->query())->links() }}
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</main>

@endsection
