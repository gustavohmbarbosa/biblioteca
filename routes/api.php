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
    Route::resource('readers', 'ReaderController');
    Route::resource('loans', 'BookReaderController');
    Route::resource('books', 'BookController');
    Route::resource('authors', 'AuthorController');
    Route::resource('companies', 'CompanyController');
    Route::prefix('companies')->name('companies.')->group(function () {
        Route::get('{company}/books', 'CompanyController@showBooks')->name('books');
        Route::get('{company}/books/{book}', 'CompanyController@showBook')->name('books');
    });
    
});