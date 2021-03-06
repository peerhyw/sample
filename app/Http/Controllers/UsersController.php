<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Https\Requests;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
use App\Models\User;
use Auth;
use Mail;

class UsersController extends Controller
{

    public  function __construct(){
        //auth: 中间件名称 expect: 要过滤的动作 指定动作不使用 auth 中间件过滤
        $this->middleware('auth',[
            'except' => ['show','create','store','index','confirmEmail']
        ]);

        $this->middleware('guest',[
            'only' => ['create']
        ]);
    }

    public function create(){
        return view('users.create');
    }

    public function show(User $user){
        $statuses = $user->statuses()
                            ->orderBy('created_at','desc')
                            ->paginate(30);
        return view('users.show',compact('user','statuses'));
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

        $this->sendEmailConfirmationTo($user);
        session()->flash('success','A verification email has been sent to your registered email address,please check it.');
        return redirect('/');
    }

    public function edit(User $user){
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }

    public function update(User $user,UserRequest $request,ImageUploadHandler $uploader){
        /*$this->validate($request,[
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        $this->authorize('update',$user);

        $data = [];
        $data['name'] = $request->name;
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success','update success');

        return redirect()->route('users.show',$user->id);*/
        $data = array_diff($request->all(), [$request->password]);

        if($request->avatar){
            $result = $uploader->save($request->avatar,'avatar',$user->id,100);
            if($result){
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }

    public function index(){
        $users=User::paginate();
        return view('users.index',compact('users'));
    }

    public function destroy(User $user){
        $this->authorize('destroy',$user);
        $user->delete();
        session()->flash('success','delete user success');
        //返回上一次操作的页面
        return back();
    }

    protected function sendEmailConfirmationTo($user){
        $view = 'emails.confirm';
        $data = compact('user');
        $to = $user->email;
        $subject = 'thanks to register,please confirm you email.';

        Mail::send($view,$data,function ($message) use ($to,$subject){
            $message->to($to)->subject($subject);
        });
    }

    public function confirmEmail($token){
        //fisrtOrFail 取出第一个用户否则返回404
        $user = User::where('activation_token',$token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);//注册后自动登录
        //session():访问回话实例 flash:存入一条缓存数据，只在下一次的请求内有效
        session()->flash('success','register success!');
        return redirect()->route('users.show',[$user]);
    }

    public function followings(User $user){
        $users = $user->followings()->paginate(30);
        $title = 'followings';
        return view('users.show_follow',compact('users','title'));
    }

    public function followers(User $user){
        $users = $user->followers()->paginate(30);
        $title = 'followers';
        return view('users.show_follow',compact('users','title'));
    }

}
