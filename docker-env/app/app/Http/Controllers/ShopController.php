<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use App\Evaluation;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //検索する
        $location = $request->input('location');
        $genre = $request->input('genre');
        $congestion = $request->input('congestion');

        $query = Shop::query();

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
            $query->where('congestion','<=', $congestion); 
        }


        
        $shops = $query->withAvg('evaluations', 'evaluation')->get();


        return view('search_results', [ 'shops' => $shops]);
    }


    public function shop_detail(Shop $shop)
    {
        $shop->load('prises');
        $shop->loadAvg('evaluations', 'evaluation');
        $shop->load('waitingtimes');

        return view('shop_detail', ['shop' => $shop]);
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
        
        return view('store_mangement');
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

        $shop->save();

        return view('store_mangement');
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

        $user = Auth::guard('stores')->user();

        $shops = Shop::where('admin_user', $user->id)->withAvg('evaluations', 'evaluation')->get();

        return view('store_mangement', ['shops' => $shops]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request){
        $shopId = $request->shopId;

        return view('store_mangement', ['shopId' => $shopId]);
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

        $shop->save();


        return redirect()->route('store.management')->with('flash_message', '編集が完了しました');
        
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
    public function shop_destroy(){
        
        $shop = Shop::find($request->shopId);

        Storage::delete('public/images/'. $shop->shop_img);

        $shop->delete();

        return view('store_mangement');
    }
}
