<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $query = User::query();
        $users = $query->get();

        return view('users',['users' => $users]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => ['nullable', 'mimes:jpg, png , jpeg'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'agency_id' => ['nullable'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'contact' => ['nullable'],
            'access_level' => ['required'],
        ]);

        User::create([
            'photo' => $request->photo,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'agency_id' => $request->agency_id,
            'email' => $request->email,
            'contact' => $request->contact,
            'access_level' => $request->access_level,
            'password' => Hash::make('00000000'), // Pr0jectl0di
        ]);

        return redirect(route('users.index'));
    }

    public function update($userID, Request $request)
    {
        $user = User::findOrFail($userID);
        $user->update([
            'photo' => $request->photo,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'agency_id' => $request->agency_id,
            'email' => $request->email,
            'contact' => $request->contact,
            'access_level' => $request->access_level,
        ]);

        return redirect(route('users.index'));
    }

    public function destroy($userID)
    {
        $user = User::findOrFail($userID);
        $user->delete();

        return redirect(route('users.index'));
    }
}
