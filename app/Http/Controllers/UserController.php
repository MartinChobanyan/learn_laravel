<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function update(Request $request, $user_id){
        $user = User::findOrFail($user_id);
        $this->validator($request, $user_id);
        
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->skype = $request->skype;
        $user->email = $request->email;

        $user->save();
        
        return response()->json(['success'  =>  "User's info has been successfully updated"]);
    }
    
    private function validator($request, $user_id){
        return $this->validate(
            $request, 
            [
                'name' => ['required', 'string', 'max:255', 'alpha'],
                'phone' => ['required_without:skype', 'nullable', 'min:6', 'max:20', Rule::unique('users')->ignore($user_id)],
                'skype' => ['required_without:phone', 'string', 'nullable', 'max:100', Rule::unique('users')->ignore($user_id)], 
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user_id)],
               // 'password' => ['required', 'string', 'min:6', 'confirmed']
            ],
            [
                'required' => 'The :attribute field is required.',
                'between' => 'The :attribute value :input is not between :min - :max.',
                'alpha' => 'The :attribute value mast contain only latyn letters.'
            ]
        );
    }
}
