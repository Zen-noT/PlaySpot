@extends('layouts.layout')
@section('content')

<main class="py-2">
    <div class="row justify-content-around">
        
        <div class='card mt-5'  >
            <div class="card-header " >
                <div class="mx-auto d-block d-flex justify-content-center">
                    <h4 >検索画面</h4>
                </div>
            </div>
            <div class="card-body ">
                <form action="{{route('shops.search')}}" method="GET" class="form-inline">
                    @csrf
                    <div class='py-2 d-flex justify-content-center'>
                        <label for="location" class="form-label">ロケーションを入力</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}">
                    </div>
                    <div class='py-2 d-flex justify-content-center'>
                        <label class="form-label">ジャンルを選択</label>
                        <select name="genre" id="genre">
                            <option value="">選択してください</option>
                            <option value="karaoke">カラオケ</option>
                            <option value="darts" >ダーツ</option>
                            <option value="bouling">ボウリング</option>
                            <option value="billiards">ビリヤード</option>
                            <option value="all">全部探す</option>
                        </select>
                    </div>
                    <div class='py-2 d-flex justify-content-center'>
                        <label class="form-label">混雑具合を選択</label>
                        <select name="congestion" id="congestion">
                            <option value="">選択してください</option>
                            <option value="0">空いているお店を検索</option>
                            <option value="1">少し並んでも探したい</option>
                            <option value="2">混んでいても探したい</option>
                        </select>
                    </div>
                    <div class='py-4 d-flex justify-content-center'>
                        <button type="submit" class="btn btn-primary">検索</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div> 
</main>







@endsection