@extends('layouts.admin_layout')
@section('content_admin')


<main>
    <div  class="container mt-5 py-5">
        <div  class="d-flex justify-content-center">
           
                <div>
                    <h3>本当に{{$store-> shop_name}}を削除してもよろしいですか？</h3>
                    
                    <div class="d-flex justify-content-center m-5">
                        <form method="POST" action="{{ route('admin.store.deleate.submit') }}" enctype="multipart/form-data">
                            @csrf
                            <input id="storeId" name="storeId" type="hidden" value="{{ $store->id }}">
                            <div>
                                <button type="submit" class="btn btn-danger btn-lg ms-5 mt-5">
                                    はい
                                </button>
                            </div>
                        </form>

                        <a href="{{ route('admin.store.management') }}" class="d-block btn btn-info btn-lg ms-5 mt-5">
                            戻る
                        </a> 
                    </div>
                </div>
           
        </div>
    </div>   
    
</main>
@endsection

