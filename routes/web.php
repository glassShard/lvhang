<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home');

Route::get('/contact', 'HomeController@contact')->name('contact');

Route::view('/live', 'live')->name('live');

Route::view('/studio', 'studio')->name('studio');

Route::resource('/records', 'RecordController');

Route::view('/news', 'news')->name('news');

Auth::routes();

Route::view('/admin', 'admin')->name('admin')->middleware('auth');


