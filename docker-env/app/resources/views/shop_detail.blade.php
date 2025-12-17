@extends('layouts.layout')
@section('content')

<main >
    <div  class="container mt-3 py-3 ">

        <div class="row mb-3 background-light"> <!---->
            <h2 class="mb-1">{{ $shop->shop_name }}</h2>

            <div class="d-flex align-items-center mt-2">
                @if (!is_null($avg))
                    <h5>☆評価　:　{{ number_format($avg, 1) }} 点</h5>
                @else
                    <h5>　評価なし　</h5>
                @endif

                <h5 class='ms-4'>予想待ち時間：{{ $waitingtime->waiting_time }}分</h5>
            </div>
        </div>

        <div class=" row">
            <div class="mb-4 ml-3 col-md-5">
                <img src="{{asset('storage/images/' . $shop->shop_img)}}" width= auto height="500" width="100%" alt="店舗画像">
            </div>
        </div>

        <table class="row mb-5 table table-bordered" style="width: 100%;">
            
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

        <div class="card d-flex flex-column align-items-center" style="width: 70%;">
            <div  class="container mt-3 py-3">

                <div class="card-body">
                    <h3>レビュー一覧</h3>
                </div>

                <div class="card-body">
                    <form>
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                
                        <div class="form-group mb-3 ">
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
                            <textarea name="comment" placeholder="コメントを入力" width='5000px'></textarea>
                        </div>
                        <button type="button" id='review_submit' class="btn btn-primary">レビューを投稿</button>
                    </form>
                </div>

                <div class="card-body">
                    <div class="review_list">
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
</main>
@endsection