@extends('layouts.admin_layout')
@section('content_admin')

<main>
    <div class="m-5">
        <h2>レビュー管理画面</h2>
    </div>
    <div class="container mt-5 py-2">
        @if($reviews->isEmpty())
            <p>該当するレビューが見つかりませんでした。</p>
        @else
            <div class="row flex-column">
            @foreach($reviews as $review)
                <div class="col-12 mb-3">
                    <div class="card p-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center" style="min-width: 0;">
                                
                                <div class="me-3">
                                    <div class="d-flex align-items-center">
                                        <h6 class='m-1'>{{ $review->shop_name}}</h6><h7>についたコメント</h7>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('storage/images/' . $review->icon)}}" 
                                            width="40" height="40" class="rounded-circle ml-1">
                                        <span class="ms-2">{{ $review->user_name }}</span>
                                    </div>
                                </div>
                            </div>

                            <div style="min-width: 0;">
                                <p class="mb-0">評価: {{ $review->evaluation }}</p>
                                <p class="mb-0 text-truncate" style="max-width: 300px;">
                                    コメント: {{ $review->comment }}
                                </p>
                            </div>

                            <p class="mb-0">登録日: {{ $review->created_at }}</p>

                            <div>
                                <form action="{{route('admin.review.update.form')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="evaluationId" value="{{ $review->id }}">
                                    <button type="submit" class="btn btn-info mb-1">レビュー編集</button>
                                </form>

                                <form action="{{route('admin.review.deleate.form')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="evaluationId" value="{{ $review->id }}">
                                    <button type="submit" class="btn btn-secondary">レビュー消去</button>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            @endforeach
            </div>
            @if(method_exists($reviews,'links'))
                <div class="d-flex justify-content-center mt-4">
                    {{ $reviews->appends(request()->query())->links() }}
                </div>
            @endif
        @endif
    </div>
</main>

@endsection