<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $table='users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function gravatar($size = '100'){
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    public static function boot(){
        parent::boot();
        static::creating(function ($user){
            $user->activation_token=str_random(30);
        });
    }

    public function sendPasswordResetNotification($token){
        $this->notify(new ResetPassword($token));
    }

    public function statuses(){
        return $this->hasMany(Status::class);
    }

    public function feed(){
        return $this->statuses()->orderBy('created_at','desc');
    }

    //关联模型 Eloquent attach sync detach 中间表

    //粉丝
    public function followers(){
                                                            //用户id   被关注  粉丝id
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }

    //关注的人
    public function followings(){
                                                            //粉丝id   关注   用户id
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }


    public function follow($user_ids){
        if(!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids,false);
    }

    public function unfollow($user_ids){
        if(!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }

    public function isFollowing($user_id){
        //$this->followings()返回一个HasMany对象
        //$this->followings返回一个Collection集合
        return $this->followings->contains($user_id);
    }

    public function feed(){
        $user_ids = Auth::user()->followings->pluck('id')->toArray();
        array_push($user_ids,Auth::user()->id);
        return Status::whereIn('user_id',$user_ids)
                            ->with('user')
                            ->orderBy('created_at','desc');
    }
}
