<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');   //create int 自增 id
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            //由 rememberToken 方法为用户创建一个 remember_token 字段，用于保存『记住我』的相关信息。
            $table->rememberToken();
            //由 timestamps方法创建了一个created_at和一个updated_at字段，分别用于保存用户的创建时间和更新时间。
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
