<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //unguard 临时取消批量赋值保护
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(FollowersTableSeeder::class);

        Model::reguard();
    }
}
