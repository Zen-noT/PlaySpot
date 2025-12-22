<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shop;
use App\Models\Evaluation;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;


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
        ->select('id', 'name', 'email', 'created_at','icon', 'profile');

        $users = $query->paginate(5);

        return view('admin_user_management', ['users' => $users]);
    }
    public function showReviewManagement(){

        $query = Evaluation::query()
        ->join('users', 'evaluations.user_id', '=', 'users.id')
        ->join('shops', 'evaluations.shop_id', '=', 'shops.id')
        ->select('evaluations.*', 'users.name as user_name', 'shops.shop_name as shop_name','users.icon');

        $reviews = $query->paginate(10);

        return view('admin_review_management', ['reviews' => $reviews]);
    }
    public function showStoreUserManagement(){

        $query = User::query()
        ->where('role', 0)
        ->select('id', 'name', 'email', 'created_at','icon');

        $store_users = $query->paginate(5);

        return view('admin_store_user_management', ['store_users' => $store_users]);
    }

    public function showStoreManagement(){

        $query = Shop::query()
        ->where('approval', 1)
        ->join('users', 'shops.admin_user', '=', 'users.id')
        ->select('shops.*', 'users.name as user_name', 'users.email as user_email', 'users.id as user_id');

        $stores = $query->paginate(5);

        return view('admin_store_management', ['stores' => $stores]);
    }
    public function showShopApproval(){

        $query = Shop::query()
        ->where('approval', 0)
        ->join('users', 'shops.admin_user', '=', 'users.id')
        ->select('shops.*', 'users.name as user_name', 'users.email as user_email', 'users.id as user_id');

        $stores = $query->paginate(5);

        return view('admin_shop_approval', ['stores' => $stores]);
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
    public function store_deleate_form(Request $request){
        
        $id = $request->storeId;

        $store = Shop::find($id);

        if (!$store) {
            return redirect()->route('admin.store.management')->with('error', '指定された店舗が見つかりません。');
        }

        return view('admin_store_deleate', ['store' => $store]);
    }
    public function store_deleate(Request $request){
        
        $store = Shop::find($request->storeId);
        if (!$store) {
            return redirect()->route('admin.store.management')->with('error', '指定された店舗が見つかりません。');
        }

        $store->delete();
        return redirect()->route('admin.store.management')->with(['message' => '店舗を削除しました。']);
    }
    public function review_deleate_form(Request $request){
        

        $review = $request->evaluationId;

        if (!$review) {
            return redirect()->route('admin.review.management')->with('error', '指定されたレビューが見つかりません。');
        }

        return view('admin_review_deleate', ['review' => $review]);
    }
    public function review_deleate(Request $request){
        
        $review = Evaluation::find($request->evaluationId);
        if (!$review) {
            return redirect()->route('admin.review.management')->with('error', '指定されたレビューが見つかりません。');
        }

        $review->delete();

        return redirect()->route('admin.review.management')->with(['message' => 'レビューを削除しました。']);
    }
    public function store_approve_form(Request $request){
        
        $id = $request->storeId;

        if (!$id) {
            return redirect()->route('admin.approval.management')->with('error', '指定された店舗が見つかりません。');
        }

        return view('admin_shop_approval_form', ['store' => $id]);
    }
    public function store_approve(Request $request){
        
        $store = Shop::find($request->storeId);
        if (!$store) {
            return redirect()->route('admin.approval.management')->with('error', '指定された店舗が見つかりません。');
        }

        $store->approval = 1;
        $store->save();

        return redirect()->route('admin.approval.management')->with(['message' => '店舗を承認しました。']);
    }
    public function store_approve_cancel_form(Request $request){
        
        $id = $request->storeId;

        if (!$id) {
            return redirect()->route('admin.store.management')->with('error', '指定された店舗が見つかりません。');
        }

        return view('admin_store_approvalCancel', ['store' => $id]);
    }
    public function store_approve_cancel(Request $request){
        
        $store = Shop::find($request->storeId);
        if (!$store) {
            return redirect()->route('admin.store.management')->with('error', '指定された店舗が見つかりません。');
        }

        $store->approval = 0;
        $store->save();

        return redirect()->route('admin.store.management')->with(['message' => '店舗の承認を取り消しました。']);
    }
    public function user_update_form(Request $request){
        
        $id = $request->userId;

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.user.management')->with('error', '指定されたユーザーが見つかりません。');
        }

        return view('admin_user_update', ['user' => $user]);
    }
    public function user_update(Request $request){
        
        $user = User::find($request->userId);

        if (!$user) {
            return redirect()->route('admin.user.management')->with('error', '指定されたユーザーが見つかりません。');
        }

        $user->name = $request->name;
        $user->profile = $request->profile;
        

        if ($request->hasFile('icon_image')) {
            Storage::delete('public/images/'. $user->icon);

            $path = $request->file('icon_image')->store('public/images/');
            $user->icon = basename($path);
        }

        $user->save();

        return redirect()->route('admin.user.management')->with(['message' => 'ユーザー情報を更新しました。']);
    }
    public function store_user_update_form(Request $request){
        
        $id = $request->userId;

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.user.management')->with('error', '指定されたユーザーが見つかりません。');
        }

        return view('admin_store_user_update', ['user' => $user]);
    }
    public function store_user_update(Request $request){
        
        $user = User::find($request->userId);

        if (!$user) {
            return redirect()->route('admin.user.management')->with('error', '指定されたユーザーが見つかりません。');
        }

        $user->name = $request->name;

        $user->save();

        return redirect()->route('admin.store.user.management')->with(['message' => 'ユーザー情報を更新しました。']);
    }







    public function store_update_form(Request $request){

        $shopId = $request->storeId;
        $shop = Shop::find($shopId);
        $genre = Genre::find($shop->genre_id);

        return view('admin_store_edit', ['shopId' => $shopId,'shop' =>$shop,'genre'=> $genre]);
    }
    public function store_update(Request $request){

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


        $shops = Shop::paginate(5);

        return view('admin_store_management', ['stores' => $shops]);
    }
    public function review_update_form(Request $request){

        $evaluationId = $request->evaluationId;
        $evaluation = Evaluation::find($evaluationId);
        
        return view('admin_review_update', ['evaluation' => $evaluation]);
    }
    public function review_update(Request $request){

        $evaluation = Evaluation::find($request->evaluationId);

        $evaluation->evaluation = $request->evaluation;
        $evaluation->comment = $request->comment;

        $evaluation->save();



        $query = Evaluation::query()
        ->join('users', 'evaluations.user_id', '=', 'users.id')
        ->join('shops', 'evaluations.shop_id', '=', 'shops.id')
        ->select('evaluations.*', 'users.name as user_name', 'shops.shop_name as shop_name','users.icon');

        $reviews = $query->paginate(10);

        return view('admin_review_management', ['reviews' => $reviews]);
    }











}
