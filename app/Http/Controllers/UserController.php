<?php

namespace App\Http\Controllers;

use App\Registration;
use App\User;
use Illuminate\Http\Request;
use \Log;

class UserController extends Controller
{
    public function addUser()
    {
        $users = User::where('type', '=', 'admin')->get();
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

    public function updateProfilePicture(Request $request)
    {
        Log::info('Updating user profile image for user ' . $request->email);
        $imageData = $request->image;
        $email = $request->email;

        try {
            $profile = Registration::where('email', '=', $email)->first();
            $profile->image = $imageData;
            $profile->save();
            Log::info('Updating user profile image successful');
            return response()->json(['success' => 'Image update successful'], 200);
        } catch (\Exception $ex) {
            Log::info('Updating user profile image failed');
            Log::error($ex);
            return response()->json(['error' => 'Image update failed'], 500);
        }
    }

    public function updateProfileInfo(Request $request)
    {
        try {
            Registration::updateOrCreate(['email' => $request->previousEmail], $request->all());
            Device::where('email', $request->previousEmail)->update(['email' => $request->email]);
            User::where('email', $request->previousEmail)->update(['email' => $request->email]);
            return response()->json(['success' => 'Profile updated successfully']);
        } catch (\Exception $ex) {
            Log::debug($ex);
            return response()->json(['error' => 'An error occured ' . $ex], 500);
        }
    }
}
