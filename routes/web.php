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

Route::get('/', function(){
    return view('home', ['posts' => App\Models\Post::get()]);
});

Route::get('post/image/{post_id}', 'PostController@getPhoto');

Auth::routes();
Route::middleware('auth', 'role:user,manager,admin')->group(function () {
    Route::prefix('profile')->group(function(){
        Route::view('/', 'profile/profile')->name('profile');

        Route::get('change-password', 'UserController@changePassword')->name('change-password');
        Route::post('change-password', 'UserController@updatePassword');
        
        Route::put('edit/{user_id}', 'UserController@profileUpdate');

        Route::prefix('my-posts')->group(function(){
            Route::get('/', 'PostController@index')->name('my-posts');
            Route::post('create', 'PostController@store')->name('post-store');
            Route::post('edit/{post_id}', 'PostController@update');
            Route::delete('delete/{post_id}', 'PostController@delete');
        });
    });

    Route::middleware('role:manager,admin')->prefix('users')->group(function() {
        Route::get('/', 'UserController@getUsers')->name('users');
        Route::put('/edit/{user_id}', 'UserController@userUpdate');
        Route::delete('/delete/{user_id}', 'UserController@delete');
    });

    Route::prefix('team')->group(function(){
        Route::get('/', 'TeamController@index');
        Route::post('create', 'TeamController@store');
        Route::get('delete/{team_id}', 'TeamController@delete');
        Route::get('{team_id}', 'TeamController@show'); 
    });
    
    Route::prefix('player')->group(function () {
        Route::post('create', 'PlayerController@store');
        Route::put('edit/{player_id}', 'PlayerController@update');
        Route::delete('delete/{player_id}', 'PlayerController@delete');

        Route::prefix('contracts')->group(function(){
            Route::get('{player_id}', 'PlayerController@getContract');
            Route::post('upload/{player_id}', 'PlayerController@uploadContract');
            Route::delete('delete/{player_id}', 'PlayerController@deleteContract');
        });
    });
});