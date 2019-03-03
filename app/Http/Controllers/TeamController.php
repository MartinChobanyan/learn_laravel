<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Stadium;

class TeamController extends Controller
{
    //
    public function index(){
        return view('teams', [
            'teams' => Team::get(),
            'stadiums' => Stadium::get()
            ]);
    }
    
    public function show($id){
        $team = Team::findOrFail($id);
        $players = $team->players;
        
        return view('team', [
            'team_id' => $id,
            'team' => $team, 
            'players' => $players
        ]);
    }

    public function store(Request $request){
        //validation
        $request->validate([
            'team_name' => 'required|min:3|max:20',
            'team_losung' => 'required|min:4|max:50',
            'stadium_id' => 'required'
        ]);
        
        $stadium = Stadium::findOrFail($request->stadium_id);

        $team = new Team;

        $team->name = $request->team_name;
        $team->losung = $request->team_losung;
        $team->stadium_id = $stadium->id;
        $team->secret = bcrypt('secret');

        $team->save();
        
        return $this->index();
    }

    public function delete($team){ // Needs realisation 
        switch(gettype($team)){
            case 'inetger': 
                Team::findOrFail($team)->delete();
                break;
            case 'string': 
                Team::where('name', $team)->delete();
                break;
        }

        return redirect('/team/' . $team)->with('response', '');
    }
}
