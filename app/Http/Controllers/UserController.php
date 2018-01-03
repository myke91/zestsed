<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function addUser()
    {
        $users = User::all();
        return view('auth.add_new_user',compact('users'));
    }
    public function postUser(Request $request)
    {
        User::create($request->all());
        return back()->with(['success'=>'User '. $request->username .' created successfully']);
    }

    public function editUser(Request $request)
    {
        if($request->ajax())
        {
            return response(User::find($request->id));
        }
    }
    public function updateUser(Request $request)
    {
        if ($request->ajax())
        {
            return response(User::updateOrCreate(['id' => $request->id], $request->all()));
        }
    }
}
