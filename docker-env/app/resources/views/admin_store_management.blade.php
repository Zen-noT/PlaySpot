@extends('layouts.admin_layout')
@section('content_admin')

<main>

    <h2>店舗管理画面</h2>

    <div class="container mt-5 py-2">
        @if($stores->isEmpty())
            <p>該当するユーザーが見つかりませんでした。</p>
        @else
            <div class="row ">
            @foreach($stores as $store) 
                <div class=" col">
                    <div class="card m-1">
                            <div class="card-body">
                                <div class="d-flex align-items-center" >
                                    <div class="flex-grow-1">
                                        
                                            <div class="d-flex align-items-center">
                                                <div class="me-4">
                                                    @if($store_user->icon)
                                                        <div>
                                                            <img src="{{asset('storage/images/' . $store_user->icon)}}" width="40" height="40" class="rounded-circle">
                                                        </div>
                                                    @else
                                                        <div>
                                                            <img src="{{asset('storage/images/NoImage.jpg')}}" width="40" height="40" class="rounded-circle">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex align-items-center flex-grow-1">
                                                    <div class="me-4 text-center">
                                                        <h2>{{ $store_user-> name}}</h2>
                                                    </div>
                                                    <div class="me-4 text-center">
                                                        <p class="p-m-not">ユーザーID: {{ $store_user-> id}}</p>
                                                    </div>
                                                    <div class="me-4 text-center">
                                                        <p class="p-m-not">メールアドレス: {{ $store_user-> email}}</p>
                                                    </div>
                                                    <div class="me-4 text-center">
                                                        <p class="p-m-not">登録日: {{ $store_user-> created_at}}</p>
                                                    </div> 
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <div>
                                        <form action="{{route('admin.store.user.deleate.form')}}" method="POST">
                                            @csrf
                                            <input id="userId" name="userId" type="hidden" value="{{ $store_user->id }}">
                                            <div>
                                                <button type="submit"  class="btn btn-secondary me-0">ユーザー消去</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        @endif
    </div>
</main>
@endsection