@extends('layouts.admin_layout')
@section('content_admin')

<main>
    <h2 class="mt-5">一般ユーザー管理画面</h2>

    <div class="container mt-5 py-2">
        @if($users->isEmpty())
            <p>該当するユーザーが見つかりませんでした。</p>
        @else
            <div class="row ">
            @foreach($users as $user) 
                <div class=" col">
                    <div class="card m-1">
                            <div class="card-body">
                                <div class="d-flex align-items-center" >
                                    <div class="flex-grow-1">
                                        
                                            <div class="d-flex align-items-center">
                                                <div class="me-4">
                                                    @if($user->icon)
                                                        <div>
                                                            <img src="{{asset('storage/images/' . $user->icon)}}" width="40" height="40" class="rounded-circle">
                                                        </div>
                                                    @else
                                                        <div>
                                                            <img src="{{asset('storage/images/NoImage.jpg')}}" width="40" height="40" class="rounded-circle">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex align-items-center flex-grow-1">
                                                    <div class="me-4 text-center">
                                                        <h2>{{ $user-> name}}</h2>
                                                    </div>
                                                    <div class="me-4 text-center">
                                                        <p class="p-m-not">ユーザーID: {{ $user-> id}}</p>
                                                    </div>
                                                    <div class="me-4 text-center">
                                                        <p class="p-m-not">メールアドレス: {{ $user-> email}}</p>
                                                    </div>
                                                    <div class="me-4 text-center">
                                                        <p class="p-m-not">登録日: {{ $user-> created_at}}</p>
                                                    </div> 
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <div>
                                        <form action="{{route('admin.user.deleate.form')}}" method="POST">
                                            @csrf
                                            <input id="userId" name="userId" type="hidden" value="{{ $user->id }}">
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