<?php

namespace App\Http\Controllers;

use App;

class LocalizationController extends Controller
{
    public function __invoke($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
