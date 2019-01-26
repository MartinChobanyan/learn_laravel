<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dbviewer extends Controller
{
    public function view(){
        $rows = \App\smodel::all();
        return view('db_view', compact('rows'));
    }
}
