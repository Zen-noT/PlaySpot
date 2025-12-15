@extends('layouts.admin_layout')
@section('content_admin')

<main>
    <h2>一般ユーザー管理画面</h2>

    <div class="container mt-5 py-2">
        @if($users->isEmpty())
            <p>該当するユーザーが見つかりませんでした。</p>
        @else
            <div class="row flex-column">
            @foreach($users as $user) 
                <div class="col-12 mb-3">
                    <div class="card p-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center" style="min-width: 0;">

                                <div class="me-3">
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
                                <div style="min-width: 0;">
                                    <div class="mb-1">
                                        <h2>{{ $user-> name}}</h2>
                                    </div>
                                    <div class="mb-0">
                                        <p class="p-m-not">ユーザーID: {{ $user-> id}}</p>
                                    </div>
                                    <div class="mb-0">
                                        <p class="p-m-not">メールアドレス: {{ $user-> email}}</p>
                                    </div>
                                    <div class="mb-0">
                                        <p class="p-m-not">登録日: {{ $user-> created_at}}</p>
                                    </div> 
                                </div>

                            </div>
                            
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
            @endforeach

            @if(method_exists($users,'links'))
                <div class="d-flex justify-content-center mt-4">
                    {{ $users->appends(request()->query())->links() }}
                </div>
            @endif
        @endif
    </div>
    
</main>
@endsection