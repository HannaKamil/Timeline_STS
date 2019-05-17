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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//----

Route::group(['middleware' => 'checkRegister'], function () {

    Route::get('/home', 'TimelineController@index')->name('home');
    Route::post('/insert', 'TimelineController@store');

    Route::get('/delete/{id}', 'TimelineController@destroy');
    Route::get('/edit/{id}', 'TimelineController@edit');
    Route::post('/update/{id}', 'TimelineController@update');

});


Route::group(['middleware' => 'admin'], function () {
    ////    Admin
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin_delete/{id}', 'AdminController@destroy');
    Route::get('/admin_edit/{id}', 'AdminController@edit');
    Route::post('/admin_update/{id}', 'AdminController@update');
});
