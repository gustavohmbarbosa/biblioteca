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

Route::get('/', 'HomeController@index')->name('home');
Route::get('books/', 'BookController@index')->name('Books.index');
Route::any('books/{slug}', 'BookController@show')->name('Books.show');
Route::get('authors/', 'AuthorController@index')->name('authors.index');
Route::get('authors/{slug}/books', 'AuthorController@show')->name('authors.show');
Route::post('/register', 'Reader\\ReaderController@store')->name('register');

/*
|--------------------------------------------------------------------------
| Reader Routes
|--------------------------------------------------------------------------
|
| Here are all reader's routes!
|
*/
Route::post('login', 'Reader\\AuthController@login')->name('login');
Route::group(['middleware' => 'auth.reader.jwt'], function () {
    Route::name('reader.')->namespace('Reader')->group(function () {
        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::get('{slug}', 'ReaderController@show')->name('show');
        Route::put('{slug}', 'ReaderController@update')->name('update');
        Route::get('{slug}/books', 'ReaderController@showBooks')->name('books');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here are all admin routes!
|
*/
Route::post('admin/login', 'Admin\\AuthController@login')->name('admin.login');
Route::group(['middleware' => 'auth.admin.jwt'], function () {
    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){

        // Users
        Route::name('users.')->group(function(){
            Route::resource('usuarios', 'UserController');
            Route::post('logout', 'AuthController@logout')->name('logout');
        });

        // Readers
        Route::resource('readers', 'ReaderController');
        Route::prefix('readers')->name('readers.')->group(function () {
            Route::get('{reader}/books', 'ReaderController@showBooks')->name('books');
            Route::get('{reader}/books/{book}', 'ReaderController@showBook')->name('books');
            Route::any('search', 'ReaderController@search')->name('search');
        });

        // Courses
        Route::resource('courses', 'CourseController');

        // Loans - Boook_Reader
        Route::resource('loans', 'BookReaderController');

        // Books
        Route::resource('books', 'BookController');
        Route::prefix('books')->name('books.')->group(function() {
            Route::any('search', 'BookController@search')->name('search');
        });

        // Companies
        Route::resource('companies', 'CompanyController');
        Route::prefix('companies')->name('companies.')->group(function () {
            Route::get('{company}/books', 'CompanyController@showBooks')->name('books');
            Route::get('{company}/books/{book}', 'CompanyController@showBook')->name('books');
        });

        // Authors
        Route::resource('authors', 'AuthorController');

        // Author_Book
        Route::resource('author_book', 'AuthorBookController');
    });
});
