<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class RandClass extends Facade{
    protected static function getFacadeAccessor() { return 'RandClass'; }
}