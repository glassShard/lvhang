<?php

use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home');

Route::get('/contact', 'HomeController@contact')->name('contact');

Route::resource('/live', 'LiveController')->only('index');

Route::view('/studio', 'studio')->name('studio');

Route::resource('/records', 'RecordController');

Route::view('/news', 'news')->name('news');

Auth::routes();

Route::get('/admin', 'AdminController@admin')->name('admin')->middleware('auth');

Route::resource('/live-ref-places', 'LiveRefPlaceController')->except('show');

Route::resource('/live-refs', 'LiveRefController')->only(['store', 'update', 'destroy']);

Route::get('/live-ref-list/{id}', 'LiveRefController@liveRefList')->name('live-ref-list');

Route::resource('/galleries', 'GalleryController')->except('create');

Route::get('/galleries/create/{studio}', 'GalleryController@create')->name('galleries.create');;

Route::post('/gallery-images/save-images/{id}', 'GalleryController@saveImages')->name('gallery-images.save-images');

Route::delete('gallery-images/delete/{id}', 'GalleryController@deleteImages')->name('gallery-images.delete');

Route::resource('/studio', 'StudioController')->only('index');

Route::get('/galleries/type/{type}', 'GalleryController@galleriesByType')->name('galleries.type');

Route::resource('/devices', 'DeviceController')->only('index', 'update', 'destroy', 'edit');

Route::get('devices/create-to-parent/{parent}', 'DeviceController@createToParent')->name('devices.create-to-parent');

Route::post('devices/store-to-parent/{parent}', 'DeviceController@storeToParent')->name('devices.store-to-parent');

Route::resource('/news', 'NewsController');

Route::group(['prefix' => 'price'], function() {

  Route::get('/{any_path?}', 'PriceController@angular')->where('any_path', '(.*)');
  
  Route::get('/edit', 'PriceController@nonexistingAuth')->name('angular.edit');
  
  Route::get('/view', 'PriceController@nonexistingNoAuth')->name('angular.view');

});






