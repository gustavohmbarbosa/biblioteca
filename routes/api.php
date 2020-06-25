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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('auth/login', 'Api\\AuthController@login');

Route::group(['middleware' => 'apiJwtAdmin'], function () {
    Route::post('auth/logout', 'Api\\AuthController@logout');
    
    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){
        Route::resource('readers', 'ReaderController');
        Route::prefix('readers')->name('readers.')->group(function () {
            Route::any('search', 'ReaderController@search')->name('search');
            Route::get('{reader}/books', 'ReaderController@showBooks')->name('books');
            Route::get('{reader}/books/{book}', 'ReaderController@showBook')->name('books');
        });

        Route::resource('loans', 'BookReaderController');
        Route::resource('author_book', 'AuthorBookController');
        Route::resource('books', 'BookController');
        Route::resource('authors', 'AuthorController');
        Route::resource('courses', 'CourseController');

        Route::resource('companies', 'CompanyController');
        Route::prefix('companies')->name('companies.')->group(function () {
            Route::get('{company}/books', 'CompanyController@showBooks')->name('books');
            Route::get('{company}/books/{book}', 'CompanyController@showBook')->name('books');
        });

    });

});
