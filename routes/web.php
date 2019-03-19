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
    Route::prefix('profile')->group(function(){
        Route::view('/', 'profile')->name('profile');

        Route::get('/change-password', 'UserController@changePassword')->name('change-password');
        Route::post('/change-password', 'UserController@updatePassword');
        
        Route::put('/edit/{user_id}', 'UserController@update');

        Route::get('/my-posts', 'PostController@index')->name('my-posts');
        Route::post('/my-posts/create', 'PostController@create')->name('post-create');
    });

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