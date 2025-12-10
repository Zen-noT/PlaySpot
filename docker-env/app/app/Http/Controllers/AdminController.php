<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shop;
use App\Models\Evaluation;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserManagement(){

        $query = User::query()
        ->where('role', 1)
        ->select('id', 'name', 'email', 'created_at','icon');

        $users = $query->get();

        return view('admin_user_management', ['users' => $users]);
    }
    public function showReviewManagement(){

        $query = Evaluation::query()
        ->join('users', 'evaluations.user_id', '=', 'users.id')
        ->join('shops', 'evaluations.shop_id', '=', 'shops.id')
        ->select('evaluations.*', 'users.name as user_name', 'shops.shop_name as shop_name');

        $reviews = $query->get();

        return view('admin_review_management', ['reviews' => $reviews]);
    }
    public function showStoreUserManagement(){

        $query = User::query()
        ->where('role', 0)
        ->select('id', 'name', 'email', 'created_at','icon');

        $store_users = $query->get();

        return view('admin_store_user_management', ['store_users' => $store_users]);
    }

    public function showStoreManagement(){

        $query = Shop::query()
        ->join('users', 'shops.user_id', '=', 'users.id')
        ->select('shops.*', 'users.name as user_name', 'users.email as user_email', 'users.id as user_id');

        $stores = $query->get();

        return view('admin_store_management', ['stores' => $stores]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function user_deleate_form(Request $request){
        
        $id = $request->userId;

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.user.management')->with('error', '指定されたユーザーが見つかりません。');
        }

        return view('admin_user_deleate', ['user' => $user]);
    }

    public function user_deleate(Request $request){
        
        $user = User::find($request->userId);
        if (!$user) {
            return redirect()->route('admin.user.management')->with('error', '指定されたユーザーが見つかりません。');
        }

        $user->delete();
        return redirect()->route('admin.user.management')->with(['message' => 'ユーザーを削除しました。']);
    }
    public function store_user_deleate_form(Request $request){
        
        $id = $request->userId;

        $store_user = User::find($id);

        if (!$store_user) {
            return redirect()->route('admin.store.user.management')->with('error', '指定された店舗ユーザーが見つかりません。');
        }

        return view('admin_storeuser_deleate', ['store_user' => $store_user]);
    }
    public function store_user_deleate(Request $request){
        
        $store_user = User::find($request->userId);
        if (!$store_user) {
            return redirect()->route('admin.store.user.management')->with('error', '指定された店舗ユーザーが見つかりません。');
        }

        $store_user->delete();
        return redirect()->route('admin.store.user.management')->with(['message' => '店舗ユーザーを削除しました。']);
    }
}
