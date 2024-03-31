<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $user = User::findOrFail(auth()->user()->id);
        
        return view('profile.index', compact('user'));
    }

    public function update(Request $request){
        $user = User::findOrFail(auth()->user()->id);

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ];

        $validateData = $request->validate($rules);

        $user->update($validateData);

        return redirect()->back()->with('success', 'Data Telah Terubah!');
    }

    public function updatePassword(Request $request){
        $rules = [
            'password' => 'required|required_with:repassword|same:repassword',
            'repassword' => 'required',
        ];

        $validateData = $request->validate($rules);
        $validateData['password'] = Hash::make($validateData['password']);
        
        $user = User::findOrFail(auth()->user()->id);
        $user->update($validateData);

        return redirect()->back()->with('success', "Password username: {$user->name}, telah diubah!");
    }
}
