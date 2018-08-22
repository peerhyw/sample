<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class SessionsController extends Controller
{
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

        if(Auth::attempt($credentials,$request->has('remember'))){
            session()->flash('success','welcome back!');
            return redirect()->route('users.show',[Auth::user()]);
        }else{
            session()->flash('danger','sorry,your email and password do not match');
            return redirect()->back();
        }
    }

    public function destroy(){
        Auth::logout();
        session()->flash('success','logout success');
        return redirect('login');
    }
}
