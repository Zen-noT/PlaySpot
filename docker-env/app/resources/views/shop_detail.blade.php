@extends('layouts.layout')
@section('content')

<main>
    <div>
        <h2>{{ $shop->shop_name }}</h2>

        <div>
            @if (!is_null($shop->evaluations_avg_evaluation))
                <p>平均評価: {{ number_format($shop->evaluations_avg_evaluation, 1) }} 点</p>
            @else
                <p>評価なし</p>
            @endif
        </div>

        <div>
            <p>予想待ち時間：{{ $shop -> waiting_time}}</p>
        </div>

        <div>
            <!-- ブックマーク -->
        </div>
    </div>

    <div>
        <div>
            <img src="{{asset('storage/images' . $shop->shop_img)}}" >
        </div>

        <div>
            <p>住所: {{ $shop->address }}</p>
            <p>電話番号: {{ $shop->tell }}</p>
            <p>公式サイト: <a href="{{ $shop->url }}" target="_blank" rel="noopener noreferrer">{{ $shop->url }}</a></p>
            <p>最寄り駅：{{$shop -> station}}</p>
        </div>
    </div>

    <div>
        //APIで取得した地図
        
    </div>

    <div>
        <form id="review_form">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    
            <label for="evaluation">評価:</label>
            <select name="evaluation" id="evaluation">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>

            <textarea name="comment" placeholder="コメントを入力"></textarea>

            <button type="button" id='review_submit'>レビューを投稿</button>
        </form>
    </div>

    <div class="reviews_list">
        <h3>レビュー一覧</h3>

        @if($evaluations->isEmpty())
            <p>まだレビューがありません。</p>
        @else
            @foreach($shop->evaluation as $evaluation)
                <div>
                    <p>評価: {{ $evaluation->evaluation }} 点</p>
                    <p>コメント: {{ $evaluation->comment }}</p>
                    <p>投稿者: {{ $evaluation->user->name }}</p>
                    <p>投稿日: {{ $evaluation->created_at->format('Y-m-d') }}</p>
                </div>
            @endforeach
        @endif
    </div>




</main>
@endsection