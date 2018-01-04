<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addUser()
    {
        $users = User::all();
        return view('auth.add_new_user', compact('users'));
    }
    public function postUser(Request $request)
    {
        $user = new User();
        if ($user->validate($request->all())) {
            if ($request->password != $request->password_confirmation) {
                return back()->with(['error' => 'Password should match confirm password']);
            } else {
                User::create($request->all());
                return back()->with(['success' => 'User ' . $request->username . ' created successfully']);
            }
        } else {
            $errors = $user->errors();
            return back()->with(['error' => $errors]);
        }
    }

    public function editUser(Request $request)
    {
        if ($request->ajax()) {
            return response(User::find($request->id));
        }
    }
    public function updateUser(Request $request)
    {
        if ($request->ajax()) {
            return response(User::updateOrCreate(['id' => $request->id], $request->all()));
        }
    }
}
