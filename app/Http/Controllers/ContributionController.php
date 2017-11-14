<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contribution;
use \Illuminate\Support\Facades\Log;
use App\Registration;
use App\Device;
use PushNotification;

class ContributionController extends Controller {

    public function contributions() {
        return view('contributions.index');
    }

    public function saveContribution(Request $request) {
        Log::debug($request);
        Log::info('calling save contribution from mobile application for -- ' . $request->userEmail);
        try {
            $user = Registration::where('email', $request->userEmail)->first();
            $id_array = ["userId" => $user->registrationId];
            $data = array_merge($id_array, $request->all());

            Log::debug($data);

            Contribution::create($data);
            Log::info('save successful');


            return response()->json(['success' => 'SAVE SUCCESSFUL'], 200);
        } catch (Exception $ex) {
            Log::info('save error');
            return response()->json(['error' => 'An error occured while saving your registration \n' . $ex->getMessage()], 500);
        }
    }

    public function approveContribution(Request $request) {
        try {
            $contribution = Contribution::find($request->id);
            $contribution->isApproved = true;
            $contribution->dateOfApproval = date('Y-m-d');

            $user = Registration::find($contribution->userId);
            $contribution->save();
            $device = Device::where('email', $user->email)->first();
            PushNotification::app('android')
                    ->to($device->deviceToken)
                    ->send("Your contribution of $contribution->contributionAmount on $contribution->dateOfContribution has been approved.");
        } catch (Exception $ex) {
            return response()->json(['error' => 'ERROR APROVING CONTRIBUTION'], 500);
        }
    }

    public function getContributions(Request $request) {
        Log::info('calling get contributions ' . $request->email);
        $user = Registration::where('email', $request->email)->first();
        Log::debug($user);
        $data = Contribution::where(['userId' => $user->registrationId, 'isApproved' => 1])->get();
        Log::debug($data);
        return response()->json($data, 200);
    }

}
