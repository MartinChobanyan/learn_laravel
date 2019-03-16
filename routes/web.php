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

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::view('/profile', 'profile')->name('profile');
    Route::get('/profile/changepassword', 'UserController@changePassword')->name('changepassword');
    Route::post('/profile/changepassword/{user_id}', 'UserController@updatePassword');
    Route::put('/profile/edit/{user_id}', 'UserController@update');

    Route::prefix('team')->group(function(){
        Route::get('/', 'TeamController@index');
        Route::post('create', 'TeamController@store');
        Route::get('{id}', 'TeamController@show'); 
    });
    
    Route::prefix('player')->group(function () {
        Route::post('create', 'PlayerController@store');
        Route::put('edit/{player_id}', 'PlayerController@update');
        Route::delete('delete/{player_id}', 'PlayerController@delete');
    });
});