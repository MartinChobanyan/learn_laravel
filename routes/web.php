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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/', 'home');

Route::middleware('auth')->group(function () {
    Route::prefix('team')->group(function(){
        Route::get('/', 'TeamController@index');
        Route::post('create', 'TeamController@store');
        Route::get('{id}', 'TeamController@show'); 
    });
    
    Route::prefix('player')->group(function () {
        Route::post('create/{team_id}', 'PlayerController@store');
        Route::put('edit/{player_id}', 'PlayerController@update');
        Route::delete('delete/{player_id}', 'PlayerController@delete');
    });
});

Auth::routes();
