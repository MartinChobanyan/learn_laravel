<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function changePassword(){
        return view('auth.passwords.authreset');
    }

    public function updatePassword(Request $request){
        $request->validate(
        [
            'current-password' => 'required|checkPassword',
            'new-password' => 'required|string|min:6|confirmed|notOldPassword',
        ]);

        $user = Auth::user();
        
        $user->password = bcrypt($request['new-password']);
        
        $user->save();

        return redirect()->back()->with('success', 'Your password has been successfuly changed!');
    }

    public function profileUpdate(Request $request, $user_id){
        $user = User::findOrFail($user_id);
        $this->validator($request, $user_id);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->skype = $request->skype;
        $user->email = $request->email;

        $user->save();

        return response()->json(['success'  =>  'Profile has been successfully updated']);
    }

    public function userUpdate(Request $request, $user_id){
        $user = User::findOrFail($user_id);
        $this->validator($request, $user_id);

        $user->fill($request->all());

        $user->save();

        return response()->json(['success'  =>  'User`s info. has been successfully updated']);
    }

    public function delete($user_id){
        User::findOrFail($user_id)->delete();

        return response()->json(['success'  =>  'User has been successfully deleted']);
    }
    
    public function getUsers(){
        return view('users/users')->with('users', User::get());
    }
    
    private function validator($request, $user_id){
        return $this->validate(
            $request, 
            [
                'name' => ['required', 'string', 'max:255', 'alpha'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user_id)],
                'phone' => ['required_without:skype', 'nullable', 'min:6', 'max:20', Rule::unique('users')->ignore($user_id)],
                'skype' => ['required_without:phone', 'string', 'nullable', 'max:100', Rule::unique('users')->ignore($user_id)],
            ],
            [
                'required' => 'The :attribute field is required.',
                'between' => 'The :attribute value :input is not between :min - :max.',
                'alpha' => 'The :attribute value mast contain only latyn letters.'
            ]
        );
    }
}
