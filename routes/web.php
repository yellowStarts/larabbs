<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// 首页
Route::get('/', 'TopicsController@index')->name('root');

// 用户认证
Auth::routes(['verify' => true]);

// 用户
Route::resource('users', 'UsersController', ['show', 'update', 'edit']);

// 话题
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

// 话题 slug 专用路由
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');

// 分类
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

// 上传图片
Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

// 评论/回复
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);

// 通知
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

// 后台鉴权
Route::get('permission-denied', 'PagesController@permissionDenied')->name('permission-denied');
