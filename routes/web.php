<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','StaticPagesController@home')->name('home');
Route::get('/help','StaticPagesController@help')->name('help');
Route::get('/about','StaticPagesController@about')->name('about');

Route::get('signup','UsersController@create')->name('signup');

/**
 * RESTful架构
 * 数据即资源 由URI指定资源
 * 获取：GET 创建：POST 修改：PATCH 删除：DELETE
 * 资源，控制器
 */

/**
 * Route::get('/users', 'UsersController@index')->name('users.index');
 * Route::get('/users/create', 'UsersController@create')->name('users.create');
 * Route::get('/users/{user}', 'UsersController@show')->name('users.show');
 * Route::post('/users', 'UsersController@store')->name('users.store');
 * Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
 * Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
 * Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');
 */

Route::resource('users','UsersController');

//显示登录页面
Route::get('login','SessionsController@create')->name('login');
//创建新会话
Route::post('login','SessionsController@store')->name('login');
//销毁会话
Route::delete('logout','SessionsController@destroy')->name('logout');

Route::get('signup/confirm/{token}','UsersController@confirmEmail')->name('confirm_email');

//显示重置密码的邮箱发送页面
Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//邮箱重设链接
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//密码更新页面
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
//执行密码更新操作
Route::post('password/reset','Auth\ResetPasswordController@reset')->name('password.update');
//创建和删除微博
/**
 * post /statuses StatusesController@store 创建
 * delete /statuses StatusesController@destroy 删除
 */
Route::resource('statuses','StatusesController',['only' => ['store','destroy']]);


/*Route::get('/', function () {
    return view('welcome');
});
