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
Route::get('livros/', 'BookController@index')->name('Books.index');
Route::any('livros/{slug}', 'BookController@show')->name('Books.show');
Route::get('autores/', 'AuthorController@index')->name('authors.index');
Route::get('autores/{slug}/livros', 'AuthorController@show')->name('authors.show');

/*
|--------------------------------------------------------------------------
| Reader Routes
|--------------------------------------------------------------------------
|
| Here are all reader's routes!
|
*/
Route::post('entrar', 'Reader\\AuthController@login')->name('login');
Route::group(['middleware' => 'auth.reader.jwt'], function () {
    Route::name('reader.')->namespace('Reader')->group(function () {
        Route::post('sair', 'AuthController@logout')->name('logout');
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
Route::post('administrativo/entrar', 'Admin\\AuthController@login')->name('admin.login');
Route::group(['middleware' => 'auth.admin.jwt'], function () {
    Route::prefix('administrativo')->name('admin.')->namespace('Admin')->group(function(){

        // Users
        Route::name('users.')->group(function(){
            Route::resource('usuarios', 'UserController');
            Route::post('sair', 'AuthController@logout')->name('logout');
        });

        // Readers
        Route::resource('leitores', 'ReaderController');
        Route::prefix('leitores')->name('readers.')->group(function () {
            Route::get('{reader}/livros', 'ReaderController@showBooks')->name('books');
            Route::get('{reader}/livros/{book}', 'ReaderController@showBook')->name('books');
            Route::any('busca', 'ReaderController@search')->name('search');
        });

        // Courses
        Route::resource('cursos', 'CourseController');

        // Loans - Boook_Reader
        Route::resource('loans', 'BookReaderController');

        // Books
        Route::resource('livros', 'BookController');
        Route::prefix('livros')->name('books.')->group(function() {
            Route::any('busca', 'BookController@search')->name('search');
        });

        // Companies
        Route::resource('editoras', 'CompanyController');
        Route::prefix('editoras')->name('companies.')->group(function () {
            Route::get('{company}/livros', 'CompanyController@showBooks')->name('books');
            Route::get('{company}/livros/{book}', 'CompanyController@showBook')->name('books');
        });

        // Authors
        Route::resource('autores', 'AuthorController');

        // Author_Book
        Route::resource('author_book', 'AuthorBookController');
    });
});
