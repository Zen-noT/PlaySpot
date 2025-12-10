@extends('layouts.admin_layout')
@section('content_admin')

<main>
    <div class="container mt-4 py-2">
        
        <h2 class="text-center mt-5 py-4">管理者画面</h2>
        
        <div class="d-flex justify-content-center">
            <div>
                <a href="{{route('admin.user.management')}}" class="btn btn-info ms-4 mt-4">
                    ユーザー管理画面
                </a>
                <a href="{{route('admin.store.user.management')}}" class="btn btn-info ms-4 mt-4">
                    店舗ユーザー管理画面
                </a>
                <a href="{{route('admin.store.management')}}" class="btn btn-info ms-4 mt-4">
                    店舗管理画面
                </a>
                <a href="{{route('admin.review.management')}}" class="btn btn-info ms-4 mt-4">
                    レビュー管理画面
                </a>
            </div>
        </div>
    </div>
</main>
@endsection