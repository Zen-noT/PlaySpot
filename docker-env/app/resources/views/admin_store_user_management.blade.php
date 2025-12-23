@extends('layouts.admin_layout')
@section('content_admin')

<main>
    <h2 class="mt-5 text-center">店舗ユーザー管理画面</h2>

    <div class="container mt-5 py-2">
        @if($store_users->isEmpty())
            <p>該当するユーザーが見つかりませんでした。</p>
        @else
            <div class="row flex-column">
            @foreach($store_users as $store_user) 
                <div class="col-12 mb-3">
                    <div class="card p-2">
                        <div class="d-flex align-items-center justify-content-between" >

                            <div class="d-flex align-items-center" style="min-width: 0;">
                                    
                                <div class="me-3">
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
                                <div style="min-width: 0;">
                                    <div class="mb-1">
                                        <h2>{{ $store_user-> name}}</h2>
                                    </div>
                                    <div class="mb-0">
                                        <p class="p-m-not">ユーザーID: {{ $store_user-> id}}</p>
                                    </div>
                                    <div class="mb-0">
                                        <p class="p-m-not">メールアドレス: {{ $store_user-> email}}</p>
                                    </div>
                                    <div class="mb-0">
                                        <p class="p-m-not">登録日: {{ $store_user-> created_at}}</p>
                                    </div> 
                                </div>
                            </div>
                            <div>

                                <form action="{{route('admin.store.user.update.form')}}" method="POST">
                                    @csrf
                                    <input id="userId" name="userId" type="hidden" value="{{ $store_user->id }}">
                                    <div>
                                        <button type="submit"  class="btn btn-info me-0 mb-2">ユーザー編集</button>
                                    </div>
                                </form>
                                <form action="{{route('admin.store.user.deleate.form')}}" method="POST">
                                    @csrf
                                    <input id="userId" name="userId" type="hidden" value="{{ $store_user->id }}">
                                    <div>
                                        <button type="submit"  class="btn btn-danger me-0">ユーザー消去</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                            
                    </div>
                </div>
                
            @endforeach
            @if(method_exists($store_users,'links'))
                <div class="d-flex justify-content-center mt-4">
                    {{ $store_users->appends(request()->query())->links() }}
                </div>
            @endif
        @endif
    </div>
    
</main>
@endsection