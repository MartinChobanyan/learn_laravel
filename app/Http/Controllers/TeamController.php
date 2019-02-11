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
            'id' => $id,
            'team' => $team, 
            'players' => $players
        ]);
    }

    public function create_team(Request $request){
        //validation
        $stadium = Stadium::findOrFail($request->stadium_id);
        $request->validate([
            'team_name' => 'required|min:3|max:20',
            'team_losung' => 'required|min:4|max:50'
        ]);

        $team = new Team;

        $team->name = $request->team_name;
        $team->losung = $request->team_losung;
        $team->stadium_id = $stadium->id; // Я пока хз как это лучше реализовать с проверкой на наличие стадиона(мб валидация?)
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
