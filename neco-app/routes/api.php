<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Broadcast::routes(['middleware' => ['auth:sanctum']]);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return response()->json(['user' => $request->user()]);
    });
    Route::post('logout', 'Auth\Api\LoginController@logout')->name('api.logout');
    Route::put('/user/update','UserController@update')->name('user.update');

    //猫情報登録
    Route::post('cat/register','CatController@register');
    Route::get('cat/mydata/{id}','CatController@catslistget');
    Route::get('cat/edit/{id}','CatController@edit');
    Route::put('cat/update','CatController@update');
});

Route::post('register', 'Auth\Api\RegisterController@register')->name('api.register');
Route::post('login', 'Auth\Api\LoginController@login')->name('api.login');

//猫掲載者の情報を取得
Route::get('posted/user/detail/{id}','UserController@detail');


Route::get('cats/data','CatController@get');
Route::get('cat/detail/{id}','CatController@detail');



//お気に入り
Route::post('cats/like/check','LikeController@check');
Route::post('cat/like','LikeController@like');
Route::post('cat/unlike','LikeController@unlike');


//メッセージ機能
Route::get('messagelist/{id}' ,'MessageRoomController@index');
Route::get('messages/{user_id_1}/{user_id_2}', 'MessageController@fetchMessages');
Route::post('send', 'MessageController@sendMessage');



