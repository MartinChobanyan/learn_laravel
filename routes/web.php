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

Route::view('/home', 'home');

Route::get('/teams', 'TeamController@index');
Route::post('/team/create', 'TeamController@create');
Route::get('/team/{id}', 'TeamController@show');

Route::post('/player/create/{team_id}', 'PlayerController@create');
Route::post('/player/edit/{player_id}', 'PlayerController@update');
Route::get('/player/delete/{player_id}', 'PlayerController@delete');