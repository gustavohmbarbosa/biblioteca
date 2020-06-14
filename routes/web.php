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

Route::view('/', 'landing');
Route::match(['get', 'post'], '/dashboard', function(){
    return view('dashboard');
});
Route::prefix('examples')->name('examples.')->namespace('examples')->group(function(){
    Route::view('/plugin-helper', 'examples.plugin_helper')->name('plugin-helper');
    Route::view('/plugin-init', 'examples.plugin_init')->name('plugin-init');
    Route::view('/blank', 'examples.blank')->name('blank');
    Route::view('/hero', 'examples.hero')->name('hero');
});

Auth::routes();

Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){
    Route::resource('reader', 'ReaderController');
});
