<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class SessionsController extends Controller
{
    public function __construct(){
        $this->middleware('guest',[
            'only' => ['create']
        ]);
    }

    public function create(){
        /*if(Auth::user()){
            return redirect()->route('users.show',[Auth::user()]);
        }*/
        return view('sessions.create');
    }

    public function store(Request $request){
        $credentials = $this->validate($request,[
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        //attempt：用户身份认证操作
        if(Auth::attempt($credentials,$request->has('remember'))){
            if(Auth::user()->activated){
                session()->flash('success','welcome back!');
                //intended 将页面重定向到上一次请求尝试访问的页面上，并接收一个默认跳转地址参数，当上一次请求记录为空时，跳转到默认地址上
                return redirect()->intended(route('users.show',[Auth::user()]));
            }else{
                Auth::logout();
                session()->flash('warning','your accout is not activated, please check your email confirmation.');
                return redirect('/');
            }

        }else{
            session()->flash('danger','sorry,your email and password do not match');
            //返回操作错误的页面
            return redirect()->back();
        }
    }

    public function destroy(){
        Auth::logout();
        session()->flash('success','logout success');
        return redirect('login');
    }
}
