<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(50)->make();
        User::insert($users->makeVisible(['password','remember_token'])->toArray());

        $user = User::find(1);
        $user->name = 'peer';
        $user->email = 'test@test.com';
        $user->password = bcrypt('123456');
        $user->is_admin = true;
        $user->activated = true;
        $user->avatar = 'http://sample.test/uploads/images/avatar/201808/29/1_1535534998_aqJ3gO77hw.jpg';
        $user->save();
    }
}
