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



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
