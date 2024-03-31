<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|required_with:repassword|same:repassword',
            'repassword' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
        ]);

        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);

        return redirect()->route('users.index')->with('success', 'Member berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required',
        ];

        $validateData = $request->validate($rules);
        $user->update($validateData);

        return redirect()->route('users.index')->with('success', 'Data Telah Terubah!');
        
    }


    public function changePassword(Request $request, $id){
        $rules = [
            'password' => 'required|required_with:repassword|same:repassword',
            'repassword' => 'required',
        ];

        $validateData = $request->validate($rules);
        $validateData['password'] = Hash::make($validateData['password']);
        
        $user = User::findOrFail($id);
        $user->update($validateData);

        return redirect()->route('users.index')->with('success', "Password username: {$user->name}, telah diubah!");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $username = $user->name;
        $user->delete();

        return redirect()->route('users.index')->with('success', "{$username} telah dihapus!");

    }
}
