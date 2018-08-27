<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user = $users->find(3);
        $user_id = $user->id;

        //获取去除掉id为3的所有用户id数组
        $followers = $users->reject(function ($user) use ($user_id){
            return $user->id == $user_id;
        });
        $follower_ids = $followers->pluck('id')->toArray();

        //关注除了3号用户以外的所有用户
        $user->follow($follower_ids);

        //除了3号用户以外的所有用户都来关注3号用户
        foreach ($followers as $follower) {
            $follower->follow($user_id);
        }
    }
}
