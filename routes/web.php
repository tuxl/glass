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

Route::get('/login', 'Login@loginPage');
Route::post('/loginsubmit', 'Login@loginSbumit');
Route::get('/logout', 'Login@logout');

Route::middleware(['accessauth'])->group(function () {
    Route::get('/initlogindata', 'Index@initLoginData');
    Route::get('/', 'Index@index');
    Route::get('/productionlist', 'ProductionController@listProduction');
    Route::get('/productionlist/detail/{id}', 'ProductionController@productionDetail')->where('id', '[0-9]+');
    Route::post('/productionlist/add', 'ProductionController@addProduction');
    Route::post('/productionlist/edit/{id}', 'ProductionController@addProduction')->where('id', '[0-9]+');
    Route::post('/productionlist/delete/{id}', 'ProductionController@deleteProduction')->where('id', '[0-9]+');
    Route::post('/productionlist/picupload/{id}', 'ProductionController@picUpload')->where('id', '[0-9]+');
});