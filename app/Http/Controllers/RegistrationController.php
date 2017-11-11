<?php

namespace App\Http\Controllers;

use \Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Registration;
use \App\Device;
use PushNotification;

class RegistrationController extends Controller {

    public function registrations() {
        return view('registrations.index');
    }

    public function saveRegistration(Request $request) {
        Log::info('calling save registration from mobile application -- ' . $request->email);
        try {
           
            Registration::create($request->all());
            Log::info('save successful');

            
            return response()->json(['success' => 'SAVE SUCCESSFUL'], 200);
        } catch (Exception $ex) {
            Log::info('save error');
            return response()->json(['error' => 'An error occured while saving your registration \n' . $ex->getMessage()], 500);
        }
    }

    public function approveRegistration() {
         $device = Device::where('email', $request - email)->first();
        PushNotification::app('android')
                    ->to($device->deviceToken)
                    ->send('Login Successful');
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
        } catch (Exception $ex) {
            Log::info('save error');
            return response()->json(['error' => 'An error occured while registering your device \n' . $ex->getMessage()], 500);
        }
    }

}
