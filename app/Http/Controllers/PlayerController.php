<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function create_player($team_id){ 
        $validator = $this->validator(request());

        if ($validator->fails()) {
            return redirect('teams/' . $team_id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $player = new Player;
        $player->name = request()->name;
        $player->nick = request()->nick;
        $player->team_id = $team_id;
        $player->secret = bcrypt('secret');
        
        $player->save();

        return redirect('/teams/' . $team_id);
    }

    public function edit($team_id, $player_id){
        return view('editor')->with('player', Player::find($player_id));
    }

    public function update($team_id, $player_id){
        $validator = $this->validator(request());

        if ($validator->fails()) {
            return redirect('teams/' . $team_id . '/edit/' . $player_id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $player = Player::find($player_id);

        $player->name = request()->name;
        $player->nick = request()->nick;

        $player->save();

        return redirect('/teams/' . $team_id);

    }

    public function delete($player){ // Needs realisation
        switch(gettype($player)){
            case 'inetger': 
                Team::findOrFail($player)->delete();
                break;
            case 'string': 
                Team::where('name', $player)->delete();
                break;
        }
        return ;
    } 

    private function validator($request){
        return Validator::make(
            $request->toArray(), 
            [
                'name' => 'required|min:8|max:50|alpha',
                'nick' => 'required|min:4|max:15|alpha'
            ],
            [
                'required' => 'The :attribute field is required.',
                'between' => 'The :attribute value :input is not between :min - :max.',
                'alpha' => 'The :attribute value mast contain only latyn letters.'
            ]
        );
    }
}
