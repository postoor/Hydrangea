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

Route::get('/', 'HomeController@index');
Route::post('/store', 'BooksController@store')->name('store');
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/manager', 'HomeController@manager')->name('manager');
Route::get('/book/{id}', function($id){
    return view('/book-single', [
        'id' => $id
    ]);
});
