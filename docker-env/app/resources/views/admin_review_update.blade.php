@extends('layouts.admin_layout')
@section('content_admin')

<main>
    <div class="container mt-5 py-5">
        <div class="d-flex justify-content-center">

            <form method="POST" action="{{ route('admin.review.update.submit') }}" enctype="multipart/form-data" >
                @csrf
                
                <div class="class='mb-3 d-flex flex-column m-3 mb-3'">
                    <label for="evaluation"> 評価 :</label>
                    <select name="evaluation" id="evaluation" >
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </div>

                <div class="class='mb-3 d-flex flex-column m-3'">
                    <textarea name="comment" placeholder="コメントを入力" style="width: 500px;"  
                        required autocomplete="comment">{{ old('comment', $evaluation->comment) }}</textarea>
                </div>

                <input type="hidden" name="evaluationId" value="{{ $evaluation->id }}">



                <div class='mt-5 d-flex justify-content-center'>
                    <button type="submit" class="btn btn-primary">
                        変更
                    </button>
                    <a href="{{ route('admin.review.management') }}" class="btn btn-secondary ms-3">
                        戻る
                    </a>
                </div>
            </form> 
        </div>   
    </div>
</main>

























@endsection