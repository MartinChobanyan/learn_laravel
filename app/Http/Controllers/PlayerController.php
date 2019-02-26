<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function create($team_id){ 
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

    public function update($team_id, $player_id){
        $validator = $this->validator(request());

        if ($validator->fails()) {
            return response()->json(['error' => $validator]);
        }

        $player = Player::find($player_id);

        $player->name = request()->name;
        $player->nick = request()->nick;

        $player->save();

        return response()->json(['success'  =>  'Player has been successfully added']);

    }

    public function delete($player_id){

        $player = Player::findOrFail($player_id);
        $team_id = $player->team->id;
        $player->delete();

        return redirect('/teams/' . $team_id)->with('response', '200: Success');
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
