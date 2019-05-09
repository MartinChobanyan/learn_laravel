<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class SearchController extends Controller
{
    public function search(Request $request){
        $data = collect(['q' => $request->search_line]);
        $players = Player::where('name', 'like', '%'.$data['q'].'%')->orderBy('id', 'ASC')->get();
        $data->put('players', $players);
        return view('search', ['data' => $data]);
    }
}
