@extends('layouts.layout')
@section('content')

<main>
    <h2>検索画面</h2>
    <form action="/shops" method="GET">
        @csrf
        <div>
            <label for="location">ロケーションを入力</label>
            <input type="text" name="location" id="location" value="{{ old('location') }}">
        </div>
        <div>
            <label>ジャンルを選択</label>
            <select name="genre" id="genre">
                <option value="">選択してください</option>
                <option value="karaoke">カラオケ</option>
                <option value="darts" >ダーツ</option>
                <option value="bouling">ボウリング</option>
                <option value="billiards">ビリヤード</option>
                <option value="all">全部探す</option>
            </select>
        </div>
        <div>
            <label>混雑具合を選択</label>
            <select name="congestion" id="congestion">
                <option value="">選択してください</option>
                <option value="0">空いているお店を検索</option>
                <option value="1">少し並んでも探したい</option>
                <option value="2">混んでいても探したい</option>
            </select>
        </div>
        <div>
            <button type="submit">検索</button>
        </div>
    </form>
</main>







@endsection