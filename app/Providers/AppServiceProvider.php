<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('checkPassword', function($attribute, $value){
            return Auth::attempt(['email' => Auth::user()->email, 'password' => $value]);
        }, 'Your current password doesn`t matche with the password you provided.');

        Validator::extend('notOldPassword', function($attribute, $value){
            return !(Hash::check($value, Auth::user()->password));
        }, 'New Password can`t be same as your current password.');
    }
}
