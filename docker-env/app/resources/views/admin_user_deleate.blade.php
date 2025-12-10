@extends('layouts.admin_layout')
@section('content_admin')


<main>
    <div  class="container mt-5 py-5">
        <div  class="d-flex justify-content-center">
           
                <div>
                    <h3>本当に{{$user-> name}}を削除してもよろしいですか？</h3>
                    
                    <div class="d-flex justify-content-center m-5">
                        <form method="POST" action="{{ route('admin.user.deleate.submit') }}" enctype="multipart/form-data">
                            @csrf
                            <input id="userId" name="userId" type="hidden" value="{{ $user->id }}">
                            <div>
                                <button type="submit" class="btn btn-danger btn-lg ms-5 mt-5">
                                    はい
                                </button>
                            </div>
                        </form>

                        <a href="{{ route('admin.user.management') }}" class="d-block btn btn-info btn-lg ms-5 mt-5">
                            戻る
                        </a> 
                    </div>
                </div>
           
        </div>
    </div>   
    
</main>
@endsection

