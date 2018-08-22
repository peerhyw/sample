<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Https\Requests;
use App\Models\User;
use Auth;

class UsersController extends Controller
{
    public function create(){
        return view('users.create');
    }

    public function show(User $user){
        return view('users.show',compact('user'));
    }

    public function store(Request $request){
        /**
         * validate:验证
         * required:是否为空
         * max min:长度限制
         * unique:唯一性验证
         */
        $this->validate($request,[
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255', //数据表users
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        Auth::login($user);//注册后自动登录
        //session():访问回话实例 flash:存入一条缓存数据，只在下一次的请求内有效
        session()->flash('success','welcome,you\'ll start a new journey.' );
        return redirect()->route('users.show',[$user]);
    }

}
