<?php

namespace App\Http\Controllers;

use \Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Registration;
use \App\Device;
use \App\User;
use PushNotification;
use \Illuminate\Support\Facades\Redirect;

class RegistrationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $regs = Registration::paginate(10);
        return view('registrations.index', compact('regs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($registrationId) {
        $reg = Registration::findOrFail($registrationId);

        return view('registrations.show', Compact('reg'));
    }

    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function saveRegistration(Request $request) {
        Log::info('calling save registration from mobile application -- ' . $request->email);
        try {

            Registration::create($request->all());
            Log::info('save successful');


            return response()->json(['success' => 'SAVE SUCCESSFUL'], 200);
        } catch (\Illuminate\Database\QueryException $ex) {
            Log::info('save error');
            return response()->json(['error' => 'An error occured while saving your registration \n' . $ex->getMessage()], 500);
        }
    }

    public function approveRegistration($id) {
        try {
            $customer = Registration::find($id);
            $customer->isApproved = true;
            $customer->dateOfApproval = date('Y-m-d');

            User::insert([
                'email' => $customer->email,
                'name' => $customer->firstName . ' ' . $customer->otherNames . ' ' . $customer->lastName,
                'password' => ''
            ]);
            $customer->save();
            $device = Device::where('email', $customer->email)->first();
            PushNotification::app('android')
                    ->to($device->deviceToken)
                    ->send("Your registration has been approved. \n Login with your email and any password to set a new password");
            return Redirect::action('RegistrationController@index');
        } catch (\Illuminate\Database\QueryException $ex) {
            $messages = ['error' => 'ERROR APROVING REGISTRATION' . $ex->getMessage()];
            return Redirect::action('RegistrationController@index')->withErrors($messages);
        }
    }

    public function registerDevice(Request $request) {
        Log::info('calling register device from mobile application -- ' . $request->email);
        try {
            $user = Registration::where('email', $request->email)->first();
            Log::debug($user);
            Log::debug($request);
            $data = [
                'deviceToken' => $request->token,
                'email' => $request->email,
                'userId' => $user->registrationId
            ];
            Device::create($data);
            Log::info('device registration successful');
            return response()->json(['success' => 'DEVICE REGISTRATION SUCCESSFUL'], 200);
        } catch (\Illuminate\Database\QueryException $ex) {
            Log::info('save error');
            return response()->json(['error' => 'An error occured while registering your device \n' . $ex->getMessage()], 500);
        }
    }

    public function showRegistration(Request $request) {

        if ($request->ajax()) {
            return response(Registration::find($request->registrationId));
        }
    }

}
