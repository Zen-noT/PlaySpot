<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


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
    public function user_update(Request $request){
        
        $user = new User;
        $record = $user->find(Auth::user()->id);

        $record->name  = $request->name;
        $record->email = $request->email;
        $record->password = $request->password;
        $record->profile = $request->profile;

        if($request->hasFile('icon_image')){

            Storage::delete('public/images/'. $record->icon);

            $path = $request->file('icon_image')->store('public/images/');
            $record->icon = basename($path);
        }

        $record->save();


        return redirect()->route('user.mypage')->with('flash_message', '編集が完了しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_delete(){
        
        $user = Auth::user();

        Storage::delete('public/images/'. $user->icon);

        $user->delete();

        Auth::logout();

        return redirect()->route('user.login')->with('flash_message', 'ユーザーを消去しました');
    }

    public function store_delete(){
        
        $user = Auth::user();

        $user->delete();

        Auth::logout();

        return redirect()->route('store.login')->with('flash_message', 'ユーザーを消去しました');
    }
}
