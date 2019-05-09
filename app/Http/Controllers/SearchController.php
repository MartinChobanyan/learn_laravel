<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class SearchController extends Controller
{
    public function search(Request $request){
        $data = collect(['q' => $request->search_line]);
        $players = Player::select('id', 'name', 'nick')->where(function ($query) use ($data) {
            $query->where('name', 'LIKE', '%'.$data['q'].'%')
                  ->orWhere('nick', 'LIKE', '%'.$data['q'].'%');
        })->orderBy('id', 'ASC')->get();
        $data->put('players', $players);
        return view('search', ['data' => $data]);
    }
}
