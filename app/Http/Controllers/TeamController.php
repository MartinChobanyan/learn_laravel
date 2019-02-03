<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    //
    public function index(Team $teams){
        return view("teams")->with("teams", $teams::get());
    }
    public function show_team(Team $teams, $id){
        $team = $teams::find($id);
        $players = $team->players;
        return view("team", [
            "team" => $teams::find($id), 
            "players" => $players,
        ]);
    }
}
