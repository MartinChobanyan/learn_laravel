<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command(
    'make:storagelink 
    {path : path that must be linked from (storage/app/...)} 
    {link_path : link path (public/...)}', 
    function($path, $link_path){
        $path = $this->argument('path');
        $link_path = $this->argument('link_path');

        if(!($path & $link_path)){
            return $this->error('Options do not exist.');
        }

        if (file_exists(public_path($link_path))) {
            return $this->error('The "' . $link_path . '" directory already exists.');
        }

        $this->laravel->make('files')->link(
            storage_path('app/' . $path), public_path($link_path)
        );

        $this->info('The ' . $path . ' directory has been linked.');
    }
)->describe('Linking storage/app directory files');