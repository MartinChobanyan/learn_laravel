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
    return view('welcome');
});

Route::get('/teams', 'TeamController@index');
Route::post('/teams/create', 'TeamController@create_team');
Route::get('/teams/{id}', 'TeamController@show_team');
Route::post('/teams/{id}/create', 'TeamController@create_player');