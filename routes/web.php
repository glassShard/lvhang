<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home');

Route::get('/contact', 'HomeController@contact')->name('contact');

Route::resource('/live', 'LiveController')->only('index');

Route::view('/studio', 'studio')->name('studio');

Route::resource('/records', 'RecordController');

Route::view('/news', 'news')->name('news');

Auth::routes();

Route::view('/admin', 'admin')->name('admin')->middleware('auth');

Route::resource('/live-ref-places', 'LiveRefPlaceController')->except('show');

Route::resource('/live-refs', 'LiveRefController')->only(['store', 'update', 'destroy']);

Route::get('/live-ref-list/{id}', 'LiveRefController@liveRefList')->name('live-ref-list');




