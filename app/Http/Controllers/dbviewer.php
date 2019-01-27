<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dbviewer extends Controller
{
    public function view(){
        $rows = \App\Models\Stadium::all();
        return $rows;
    }
}
