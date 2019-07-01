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

Route::get('/', function () {
    return redirect('bands');
});

Route::resource('bands', 'BandController');
Route::get('bands/{sortfield}/{sortdir?}', 'BandController@sortedindex')->name('bands.sortedindex');

Route::resource('albums', 'AlbumController');
Route::get('albums/byband/{band_id}/{sortfield?}/{sortdir?}', 'AlbumController@byband')->name('albums.byband');
Route::get('albums/{sortfield}/{sortdir?}', 'AlbumController@sortedindex')->name('albums.sortedindex');
