@extends('layouts.layout')
@section('content')

<main class="py-5 container">
    <div class="d-flex justify-content-center">
        <div class=" justify-content-around">
            <div class='card'>
                <div class="card-header" >
                    <div class=" d-flex justify-content-center">
                        <h4 >検索画面</h4>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="mt-4">
                        <form action="{{route('shops.search')}}" method="GET" class="row mb-5 d-flex justify-content-center">
                            @csrf
                            <div class="col-md-3">
                                <label for="location">ロケーションを入力</label>
                                <input type="text" name="location" id="location" value="{{ old('location') }}" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>ジャンルを選択</label>
                                <select name="genre" id="genre" class="form-control">
                                    <option value="">選択してください</option>
                                    <option value="karaoke">カラオケ</option>
                                    <option value="darts" >ダーツ</option>
                                    <option value="bouling">ボウリング</option>
                                    <option value="billiards">ビリヤード</option>
                                    <option value="all">全部探す</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>混雑具合を選択</label>
                                <select name="congestion" id="congestion" class="form-control">
                                    <option value="">選択してください</option>
                                    <option value="0">空いているお店を検索</option>
                                    <option value="1">少し並んでも探したい</option>
                                    <option value="2">混んでいても探したい</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <br>
                                <button type="submit" class="btn btn-primary">検索</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div> 
    </div>
</main>







@endsection