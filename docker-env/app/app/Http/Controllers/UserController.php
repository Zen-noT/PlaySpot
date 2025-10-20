<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;





class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function user_create(){
        return view('user_create');
    }

    public function store_create(){
        return view('store_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function user_store(Request $request){
        $user = new User;

        //　画像を保存
        $icon_img = $request->file('icon_image')->store('public/images/');
        $user->icon = basename($icon_img);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->profile = $request->profile;
        $user->role = 1;

        $user->save();
        return redirect()->route('user.login')->with('success', 'ユーザー登録が完了しました。ログインしてください。');
    }
    
    public function store_store(Request $request){
        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 0;

        $user->save();
        return redirect()->route('store.login')->with('success', '店舗ユーザー登録が完了しました。ログインしてください。');
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
    public function user_update(Request $request, $id){
        //画像消去忘れずに
        $user = new User;
        $record = $user->find(Auth::user()->id);

        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_delete($id)
    {
        //
    }
}
