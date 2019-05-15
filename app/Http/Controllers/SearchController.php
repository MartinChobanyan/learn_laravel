<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;
use App\Models\Stadium;

class SearchController extends Controller
{
    public function search(Request $request){
        $data = collect(['q' => $request->search_line]);
        
        $stadiums = Stadium::
            select(
                'name', 'stadium as type'
            )
            ->where('name', 'LIKE', '%'.$data['q'].'%');
        $teams = Team::
            select(
                'name', 'team as type'
            )
            ->where('name', 'LIKE', '%'.$data['q'].'%');
        $search_results = Player::
            select(
                \DB::raw("(name || ' ' || nick) as name"), 'player as type'
            )
            ->where(function ($query) use ($data) {
                $query->where('name', 'LIKE', '%'.$data['q'].'%')
                    ->orWhere('nick', 'LIKE', '%'.$data['q'].'%');
            })
            ->unionAll($stadiums)
            ->unionAll($teams)
            ->get();
        $data->put('search_results', $search_results);
        return view('search', ['data' => $data]);
    }
}
