<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Stadium;
use App\Models\Player;

class TeamController extends Controller
{
    //
    public function index(){
        return view("teams")->with("teams", Team::get());
    }
    
    public function show_team($id){
        $team = Team::findOrFail($id);
        $players = $team->players;
        
        return view("team", [
            "id" => $id,
            "team" => $team, 
            "players" => $players
        ]);
    }

    public function create_team(Request $request){
        $team = new Team;

        $team->name = $request->name;
        $team->losung = $request->losung;
        $team->stadium_id = Stadium::where('name', $request->stadium_name)->firstOrFail()->id; // Я пока хз как это лучше реализовать с проверкой на наличие стадиона(мб валидация?)
        $team->secret = bcrypt('secret');

        $team->save();
        
        return $this->index();
    }

    public function create_player($team_id){
        request()->validate([
            'name' => 'required|min:8|max:50|alpha',
            'nick' => 'required|min:4|max:15|alpha'
        ]);

        $player = new Player;
        $player->name = request()->name;
        $player->nick = request()->nick;
        $player->team_id = $team_id;
        $player->secret = bcrypt('secret');
        
        $player->save();

        return $this->show_team($team_id);
    }
}
