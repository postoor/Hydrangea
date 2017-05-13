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
Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::post('/store', 'BooksController@store')->name('store');
Route::get('/manager', 'HomeController@manager')->name('manager');
Route::get('/book/{id}', function($id){
    return view('book-single', [
        'id' => $id
    ]);
})->name('book-single');

Route::post('/auto', 'BooksController@auto')->name('auto');

#書籍搜尋及顯示功能 2017-05-07 route api無法讀取Client的Request 故轉至route web實現登入使用。
Route::get('/books', 'BooksController@index')->name('ShowAll');
Route::get('/books/{id}', 'BooksController@show')->name('ShowOne');
Route::post('/books/search', 'BooksController@search')
        ->name('searchISBN');