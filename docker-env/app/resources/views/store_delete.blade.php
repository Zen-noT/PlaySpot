@extends('layouts.store_layout')
@section('content_store')

<main>
    <div  class="container mt-5 py-5">
        <<div  class="d-flex justify-content-center">
            <div>
                <h3>本当にアカウントを消去してもよろしいですか？</h3>
                
                <div class="d-flex justify-content-center m-5">
                    <form method="POST" action="{{ route('store.delete.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <button type="submit"class="d-block btn btn-secondary btn-lg ms-5 mt-5" >
                                はい
                            </button>
                        </div>
                    </form>

                    <a href="{{ route('store.management') }}" class="d-block btn btn-info btn-lg ms-5 mt-5">
                        戻る
                    </a>  
                </div>
            </div>
        </div>
    </div>  
    
</main>


@endsection