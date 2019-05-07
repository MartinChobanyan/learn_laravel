<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Stadium;
use App\Models\PlayerRole;
use App\Facades\RandClass;

class TeamController extends Controller
{
    //
    public function index(){
        return view('teams/teams', [
            'teams' => Team::get(),
            'stadiums' => Stadium::get()
            ]);
    }
    
    public function show($team_id){
        $team = Team::findOrFail($team_id);
        $players = $team->players;
        $roles = PlayerRole::get();
        $total_salary = 0;
        $chart_data = [];

        foreach($roles as $role) {
            foreach($players as $player) {
                if($player->role->name === $role->name) {
                    if(!isset($chart_data[$role->name])) $chart_data[$role->name] = 0;
                    $chart_data[$role->name] += $player->salary;
                    $total_salary += $player->salary;
                }
            }
        }
        
        return view('teams/team', [
            'team_id' => $team_id,
            'team' => $team, 
            'players' => $players,
            'roles' => $roles,
            'rand_player' => RandClass::get('male', '', 5, 15),
            'chart_data' => $chart_data,
            'total_salary' => $total_salary
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

        $team->save();
        
        return redirect()->back();
    }

    public function delete($team_id){
        Team::findOrFail($team_id)->delete();

        return redirect()->back()->with('del-success', 'Team has been successfully deleted!');
    }
}
