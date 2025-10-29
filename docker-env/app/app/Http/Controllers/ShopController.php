<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Genre;
use App\Models\Waitingtime;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){
        //検索する
        $location = $request->input('location');
        $genre = $request->input('genre');
        $congestion = $request->input('congestion');

        $query = Shop::query()
        ->join('genres', 'shops.genre_id', '=', 'genres.id')
        ->join('waitingtimes', 'waitingtimes.shop_id', '=', 'shops.id') 
        ->select('shops.*', 'waitingtimes.waiting_img');

        if ($location) {
            $query->where('address', 'like', '%' . $location . '%');
        }

        if ($genre) {
            if ($genre == 'karaoke') {
                $query->where('karaoke', 1);
            } elseif ($genre == 'darts') {
                $query->where('darts', 1);
            } elseif ($genre == 'bouling') {
                $query->where('bouling', 1);
            } elseif ($genre == 'billiards') {
                $query->where('billiards', 1);
            } elseif ($genre == 'all') {
                $query->where(function($q) {
                    $q->where('karaoke', 1)
                      ->orWhere('darts', 1)
                      ->orWhere('bouling', 1)
                      ->orWhere('billiards', 1);
                });
            }
        }

        if ($congestion) {
            $query->where('waitingtimes.waiting_img', '<=', $congestion); 
        }

        //$shops = $query->withAvg('evaluations', 'evaluation')->get();
        $shops = $query->with('evaluations')->get();

        foreach ($shops as $shop) {
            $shop->evaluations_avg = $shop->evaluations->avg('evaluation');
        }
    
        return view('search_results', [ 'shops' => $shops]);
    }


    public function shop_detail($shop){

        $shops = Shop::where('id', $shop)->first();

        $avg = Evaluation::where('shop_id', $shop)->avg('evaluation');

        $waitingtimes = Waitingtime::where('shop_id', $shop)->first();

        $comment = Evaluation::where('shop_id', $shop)->get();
        

        return view('shop_detail', ['shop' => $shops,'avg' => $avg,'waitingtime' =>$waitingtimes, 'evaluations'=>$comment]);
    }
    
    public function evaluation_create(Request $request)
    {
        $evaluation = new Evaluation();
        $evaluation->shop_id = $request->input('shop_id');
        $evaluation->user_id = $request->input('user_id');
        $evaluation->evaluation = $request->input('evaluation');
        $evaluation->comment = $request->input('comment');
        $evaluation->save();

        return response()->json([
            'success' => true,
            'evaluation' => $evaluation->evaluation,
            'comment' => $evaluation->comment,
            'user_name' => $evaluation->user->name,
            'created_at' => $evaluation->created_at->format('Y-m-d')
        ]);
    }

    public function wait_time_update(Request $request){

        $shop = Waitingtime::where('shop_id', $request->shopId)->first();

        $shop->waiting_img = $request->wait_img;
        $shop->waiting_time = $request->wait_time;

        $shop->save();

        $shops = Shop::all();

        return view('store_management', ['shops' => $shops]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shop_create(Request $request){

        $shop = new Shop;

        $shop_img = $request->file('shop_img')->store('public/images/');
        $shop->shop_img = basename($shop_img);


        $shop->shop_name = $request->shop_name;
        $shop->address = $request->address;
        $shop->url = $request->url;
        $shop->tell = $request->tell;
        $shop->station = $request->station;
        $shop->admin_user = Auth::id();

        $genre = new Genre();

        if ($request->karaoke == '1') {
            $genre->karaoke = '1';
        }elseif($request->karaoke !== '1'){
            $genre->karaoke = '0';
        }

        if ($request->darts == '1') {
            $genre->darts = '1';
        } elseif($request->darts !== '1'){
            $genre->darts = '0';
        }

        if ($request->bouling == '1') {
            $genre->bouling = $request->bouling;
        } elseif($request->bouling !== '1'){
            $genre->bouling = '0';
        }

        if ($request->billiards == '1') {
            $genre->billiards = $request->billiards;
        } elseif($request->billiards !== '1'){
            $genre->billiards = '0';
        }
        $genre->save();

        $shop->genre_id = $genre->id;

        $shop->save();

        $waiting = new Waitingtime;

        $waiting->shop_id = $shop->id;

        $waiting->save();

        $shops = Shop::all();

        return view('store_management', ['shops' => $shops]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show_management(){

        //$user = Auth::guard('stores')->user();
        $user = Auth::user(); 

        $shops = Shop::where('admin_user', $user->id)
        ->withCount([
            'evaluations as evaluations_avg_evaluation' => function ($query) {
                $query->select(DB::raw('coalesce(avg(evaluation), 0)'));
            }
        ])->get();

        return view('store_management', ['shops' => $shops]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request){
        $shopId = $request->shopId;
        $shop = Shop::findOrFail($shopId);
        $genre = Genre::find($shop->genre_id);

        return view('shop_edit', ['shopId' => $shopId,'shop' =>$shop,'genre'=> $genre]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function shop_update(Request $request){

        $shop = Shop::find($request->shopId);

        $shop->shop_name = $request->shop_name;
        $shop->address = $request->address;
        $shop->url = $request->url;
        $shop->tell = $request->tell;
        $shop->station = $request->station;

        if($request->hasFile('shop_img')){

            Storage::delete('public/images/'. $shop->shop_img);

            $path = $request->file('shop_img')->store('public/images/');
            $shop->shop_img = basename($path);
        }

        $genre = Genre::find($shop->genre_id);

        if ($request->karaoke == '1') {
            $genre->karaoke = 1;
        } else {
            $genre->karaoke = 0;
        }

        if ($request->darts == '1') {
            $genre->darts = 1;
        } else {
            $genre->darts = 0;
        }

        if ($request->bouling == '1') {
            $genre->bouling = 1;
        } else {
            $genre->bouling = 0;
        }

        if ($request->billiards == '1') {
            $genre->billiards = 1;
        } else {
            $genre->billiards = 0;
        }

        $genre->save();
        $shop->save();


        $shops = Shop::all();

        return view('store_management', ['shops' => $shops]);
        
    }

    public function shop_delete_form(Request $request){

        $shopId = $request->shopId;

        return view('shop_delete', ['shopId' => $shopId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function shop_destroy(Request $request){
        
        $shop = Shop::find($request->shopId);

        Storage::delete('public/images/'. $shop->shop_img);

        $shop->delete();

        $shops = Shop::all();

        return view('store_management', ['shops' => $shops]);
    }
}
