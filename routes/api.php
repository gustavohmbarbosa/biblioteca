<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){
    Route::resource('reader', 'ReaderController');
    //Route::resource('loan', 'BookReaderController');
    Route::resource('book', 'BookController');

    //Route::post('/store/author', 'BookController@storeAuthor')->name('book.store.author');
    //Route::get('/return/authors', 'BookController@returnAuthors')->name('book.return.authors');
});