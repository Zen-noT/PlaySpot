@extends('layouts.layout')
@section('content')

<main>
    <div  class="container mt-3 py-3">
        <div class="row mb-5 ">

            <h2 class="col-md-5">{{ $shop->shop_name }}</h2>

            <div class="col-md-4">
                @if (!is_null($avg))
                    <h5>☆評価　:　{{ number_format($avg, 1) }} 点</h5>
                @else
                    <h5>　評価なし　</h5>
                @endif
            </div>

            <div class="col-md-3">
                <h5>予想待ち時間：{{ $waitingtime->waiting_time }}分</h5>
            </div>

            <div>
                <!-- ブックマーク -->
            </div>
        </div>
    

        <div class="row mb-5 ">
            <div class="mb-5 ml-3 col-md-5">
                <img src="{{asset('storage/images/' . $shop->shop_img)}}" width= auto height="300">
            </div>

            <div class="col-md-4">
                <p>住所: {{ $shop->address }}</p>
                <p>電話番号: {{ $shop->tell }}</p>
                <p>公式サイト: <a href="{{ $shop->url }}" target="_blank" rel="noopener noreferrer">{{ $shop->url }}</a></p>
                <p>最寄り駅：{{$shop -> station}}</p>
            </div>
        </div>

        <div class="row mb-5 ">
            
            <!-- APIで取得した地図 -->
            <iframe id='map' src='https://www.google.com/maps/embed/v1/place?key={{ config("services.google-map.apikey") }}&q={{ $shop->address }}'
                width='30%' height='300' frameborder='0' class='col-md-5'>
            </iframe>

            <div class="col-md-5">
                <form>
                    @csrf
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            
                    <div class="form-group mb-3 mt-5">
                        <label for="evaluation"> 評価 :</label>
                        <select name="evaluation" id="evaluation">
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <textarea name="comment" placeholder="コメントを入力"></textarea>
                    </div>
                    <button type="button" id='review_submit' class="btn btn-primary">レビューを投稿</button>
                </form>
            </div>
        </div>

        <div class="card" style="width: 70%;">
            <div  class="container mt-3 py-3">
                <div class="review_list">
                    <div class="card-heade">
                        <h3>レビュー一覧</h3>
                    </div>
                    <div class="card-body">
                        @if($evaluations->isEmpty())
                            <p>まだレビューがありません。</p>
                        @else
                            @foreach($evaluations as $evaluation)
                                <div class="card mt-3 p-3">
                                    <p>評価: {{ $evaluation->evaluation }} 点</p>
                                    <p>コメント: {{ $evaluation->comment }}</p>
                                    <p>投稿者: {{ $evaluation->user->name }}</p>
                                    <p>投稿日: {{ $evaluation->created_at->format('Y-m-d') }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection