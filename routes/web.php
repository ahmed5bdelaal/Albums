<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ImageController;

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



Route::controller(AlbumController::class)->group(function(){

    Route::get('/albums', 'index');
    Route::get('/albums/all', 'getUserDatatable')->name('albums.all');
    Route::get('/albums/create', 'create')->name('albums.create');
    Route::get('/albums/edit/{id}', 'edit')->name('albums.edit');
    Route::post('/albums/update/{id}', 'update')->name('albums.update');
    Route::get('/albums/{album}', 'show')->name('albums.show');
    Route::post('/albums', 'store')->name('albums.store');
    Route::delete('/albums/{id}', 'destroy')->name('albums.destroy');
    Route::get('/albums/trans/{id}','trans')->name('albums.trans');
    Route::get('/albums/trans/{album}/{id}','transfer')->name('albums.transfer');
});

Route::controller(ImageController::class)->group(function(){

    Route::get('/photos', 'index')->name('photos.indexe');
    Route::get('/photo/upload/{album_id}', 'create')->name('photos.create');
    Route::post('/photo/upload', 'store')->name('photos.store');
    Route::get('/photo/{photo}', 'show')->name('photos.show');
    Route::delete('/photo/{id}', 'destroy')->name('photos.destroy');

});

