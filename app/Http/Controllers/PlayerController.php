<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class PlayerController extends Controller
{
    public function store(Request $request){ 
        $this->validator($request);

        $player = new Player;
        
        $player->fill($request->all());
        $player->salary = $request->salary;

        $player->save();

        return redirect('/team/' . $player->team_id);
    }

    public function update(Request $request, $player_id){
        $this->validator($request);

        $player = Player::findOrFail($player_id);

        $player->fill($request->all());
        $player->salary = $request->salary;
        
        $player->save();

        return response()->json(['success'  =>  'Player`s info has been successfully updated']);
    }

    public function delete($player_id){
        Player::findOrFail($player_id)->delete();

        return response()->json(['success'  =>  'Player has been successfully deleted']);
    } 

    public function getContract($player_id){
        $player = Player::findOrFail($player_id);
        $file = Storage::get($player->contract);
        $mimeType = Storage::mimeType($player->contract);

        $response = Response::make($file);
        $response->header('Content-Type', $mimeType);

        return $response;
    }

    public function uploadContract(Request $request, $player_id){
        $request->validate([
            'contract' => 'required|mimes:pdf|max:3072',
        ]);

        $player = Player::findOrFail($player_id);
        if($player->contract) Storage::delete($player->contract);
        $player->contract = $request->contract->store('player/contracts');
        $player->save();
        
        return response()->json(['success'  =>  'Player`s contract has been successfully uploaded']);
    }

    public function deleteContract($player_id){
        $player = Player::findOrFail($player_id);

        Storage::delete($player->contract); 
        $player->contract = null;
        
        $player->save();

        return response()->json(['success' => 'Player`s contract has been successfully deleted']);
    }

    private function validator($request){
        return $this->validate(
            $request, 
            [
                'name' => 'required|min:4|max:50|alpha',
                'nick' => 'required|min:4|max:15|alpha',
                'role_id' => 'required',
                'salary' => 'nullable|min:0|max:999999999999'
            ],
            [
                'required' => 'The :attribute field is required.',
                'role_id.required' => 'The role must be selected appropriately.',
                'between' => 'The :attribute value :input is not between :min - :max.',
                'alpha' => 'The :attribute value mast contain only latyn letters.'
            ]
        );
    }
}
