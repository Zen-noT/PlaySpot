@extends('layouts.admin_layout')
@section('content_admin')


<main>
    <div  class="container mt-5 py-5">
        <div  class="d-flex justify-content-center">
           
                <div>
                    <h3>本当に承認してもよろしいですか？</h3>
                    
                    <div class="d-flex justify-content-center m-5">
                        <form method="POST" action="{{ route('admin.store.approve.submit') }}" enctype="multipart/form-data">
                            @csrf
                            <input id="storeId" name="storeId" type="hidden" value="{{ $store }}">
                            <div>
                                <button type="submit" class="btn btn-danger btn-lg ms-5 mt-5">
                                    はい
                                </button>
                            </div>
                        </form>

                        <a href="{{ route('admin.review.management') }}" class="d-block btn btn-info btn-lg ms-5 mt-5">
                            戻る
                        </a> 
                    </div>
                </div>
           
        </div>
    </div>   
    
</main>
@endsection

