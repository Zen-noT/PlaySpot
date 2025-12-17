<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <!-- 画面のサイズ設定 -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token　（セキュリティ） -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'larabel') }}</title>

        <!-- jQuery読み込み -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        
        <!-- 読み込み高速化 -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <!-- グーグル提供のフォント -->
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- スタイルシート読み込み -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <!-- splidejs　読み込み　-->
        <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    </head>
    <body>
        
        <header class="card navbar   mt-1  sticky-top kasane">
            <div class="container justify-content-between ">
                <div class="navbar-brand sirotai">
                    <p>待ち時間で検索できる　店舗検索サイト</p>
                </div>

                <form action="{{route('shops.search')}}" method="GET" class="row d-flex justify-content-center">
                    @csrf
                    <div class="col-md-3">
                        <input type="text" name="location" id="location" value="{{ old('location') }}" class="form-control" placeholder="地域を入力">
                    </div>
                    <div class="col-md-3">
                        <select name="genre" id="genre" class="form-control">
                            <option value="">ジャンルを選択</option>
                            <option value="karaoke">カラオケ</option>
                            <option value="darts" >ダーツ</option>
                            <option value="bouling">ボウリング</option>
                            <option value="billiards">ビリヤード</option>
                            <option value="all">全部探す</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="congestion" id="congestion" class="form-control">
                            <option value="">混雑具合を選択</option>
                            <option value="0">空いているお店を検索</option>
                            <option value="1">少し並んでも探したい</option>
                            <option value="2">混んでいても探したい</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">検索</button>
                    </div>
                </form>

                <div class="align-items-center"> 
                    @if(Auth::check())
                        <span style="font-size: 1.7rem;" class="siro">{{ Auth::user()->name }}</span>

                        <a href="{{ route('user.mypage') }}" class="px-2">
                            <img src="{{asset('storage/images/' . Auth::user()->icon )}}" width="40" height="40" class="rounded-circle">
                            <img src="{{asset('storage/images/' . 'hanbarger.png' )}}" width="25" height="25" >
                        </a>
                        

                        <a href="#" id="logout" class="siro"> ログアウト</a>
                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <script>
                            document.getElementById('logout').addEventListener('click', function(event) {
                                event.preventDefault();
                                document.getElementById('logout-form').submit();
                            });
                        </script>
                    @endif
                </div>
            </div>   
            
            
                          
        </header>

        <!-- スライド -->
        <div class="splide auto-splide mb-5 mt-0 haikei">

            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide"><img src="{{ asset('storage/images/image_darts.jpg') }}" alt="Slide 1"></li>
                    <li class="splide__slide"><img src="{{ asset('storage/images/image_bowling.jpg') }}" alt="Slide 2"></li>
                    <li class="splide__slide"><img src="{{ asset('storage/images/image_billiards.jpg') }}" alt="Slide 3"></li>
                    <li class="splide__slide"><img src="{{ asset('storage/images/image_karaoke.jpg') }}" alt="Slide 4"></li>
                </ul>
            </div>
            <div class="splide__pagination"></div>
            <div class="splide__arrows">
                <button class="splide__arrow splide__arrow--prev">◁</button>
                <button class="splide__arrow splide__arrow--next">▷</button>
            </div>

        </div>

        <main class="py-1 container">
            <div class="d-flex justify-content-center">
                <div class=" justify-content-around">

                    <div class=" d-flex justify-content-center m-1">
                        <h4>最近登録されたお店</h4>
                    </div>

                    <div class="container mt-3 py-2">
                        @if($shops->isEmpty())
                            <p>該当するお店が見つかりませんでした。</p>
                        @else
                            @foreach($shops as $shop)  
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="d-flex align-items-center">
                                                <div class="col-md-2">
                                                    <img src="{{asset('storage/images/' . $shop->shop_img)}}" width="120" height="120">
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{route('shops.detail',['shop'=> $shop->id ]) }}" >
                                                        <h2>{{ $shop->shop_name }}</h2>
                                                    </a>
                                                    <p class='pt-3'>住所: {{ $shop->address }}</p>
                                                </div>
                                                <div class="col-md-3 d-flex justify-content-end">
                                                    @if (!is_null($shop->evaluations_avg))
                                                        <p>☆評価　:　 {{ number_format($shop->evaluations_avg, 1) }} 点</p>
                                                    @else
                                                        <p>評価なし</p>
                                                    @endif
                                                </div>
                                                <div class="col-md-3  d-flex justify-content-end pr-5">
                                                    @if ($shop->waiting_img === 0)
                                                        <p>混雑状況　:　空いている</p>
                                                    @elseif($shop->waiting_img === 1)
                                                        <p>混雑状況　:　やや混雑</p>
                                                    @elseif($shop->waiting_img === 2)
                                                        <p>混雑状況　:　混雑</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if(method_exists($shops,'links'))
                            <div class="d-flex justify-content-center mt-4">
                                {{ $shops->appends(request()->query())->links() }}
                            </div>
                            @endif

                        @endif
                    
                    </div>

                    
                </div> 
            </div>
        </main>

            
            
       <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
        <script src="{{ mix('js/app.js') }}"></script>

        
    </body>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Splide('.auto-splide', {
                type: 'fade',
                rewind: true,
                autoplay: true,
                interval: 4000,
                pauseOnHover: false,
            }).mount();
        });
    </script>
</html>



