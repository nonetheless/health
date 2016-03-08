<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/game','GameController@index');

Route::get('/game/new','GameController@create');

Route::get('/game/all','GameController@all');

Route::post('/game/update','GameController@upd');

Route::get('/game/join/{id}','GameController@join');

Route::get('/game/out/{id}','GameController@out');

Route::get('/game/change/{id}','GameController@change');

Route::get('/game/del/{id}','GameController@del');

Route::post('/game/store','GameController@store');

Route::get('/game/{id}','GameController@show');


Route::get('/register','LoginController@register');

Route::post('/register/check','LoginController@store');

Route::get('/setting/{id}','UserController@set');



Route::post('/login/check','LoginController@login');

Route::get('/login','LoginController@index');

Route::get('/login/admin','LoginController@admin');

Route::post('/login/admincheck','LoginController@adminLogin');

Route::post('/user/updateInfo','UserController@updateInfo');

Route::post('/user/updatePassword','UserController@updatePassword');

Route::post('/user/updateImg','UserController@updateImg');


Route::get('/user/home/{id}','UserController@show');


Route::get('/admin','UserController@adminAdd');

Route::get('/turn','UserController@turn');

Route::get('/admin/change','UserController@adminChange');

Route::get('/admin/del/{id}','UserController@adminDel');

Route::post('/admin/store','UserController@adminStore');

Route::post('/admin/updateInfo','UserController@adminInfo');

Route::post('/admin/updatePass','UserController@adminPass');

Route::get('/advice','UserController@advice');

Route::get('/advice/user/{id}','UserController@adviceOne');

Route::post('/advice/inputAll','UserController@adviceInputAll');

Route::post('/advice/inputOne','UserController@adviceInputOne');

Route::get('/health/import','MainController@import');

Route::get('/health/user','MainController@user');

Route::post('/health/store','MainController@store');