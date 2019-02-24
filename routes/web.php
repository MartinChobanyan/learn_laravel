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
Route::post('/teams/create', 'TeamController@create');
Route::get('/teams/{id}', 'TeamController@show');

Route::post('/teams/{id}/create', 'PlayerController@create_player');
Route::get('/teams/{team_id}/edit/{player_id}', 'PlayerController@edit');
Route::post('/teams/{team_id}/edit/{player_id}', 'PlayerController@update');
Route::get('/teams/{team_id}/delete/{player_id}', 'PlayerController@delete');