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
use Illuminate\Support\Facades\Auth;

//Route::get('/', function () {
//    return view('index');
//});

//Auth::routes();

//Route::get('login', array('as'=>'login', 'uses' => 'Auth\AuthController@redirectToGoogle')) ;
Route::group(['middleware' => ['web','guest']], function() {
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');
});

//Route::get('auth/google', 'Auth\AuthController@redirectToGoogle');
//Route::get('auth/google/callback', 'Auth\AuthController@handleGoogleCallback');

Route::get('auth/detik', 'Auth\DetikController@redirectToDetik')->name('detikconnect');
Route::get('auth/detik/callback', 'Auth\DetikController@handleDetikCallback');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function() {
	Route::get('/', 'IndexController@index')->name('index');
});


