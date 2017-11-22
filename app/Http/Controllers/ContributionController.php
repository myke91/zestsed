<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contribution;
use \Illuminate\Support\Facades\Log;
use App\Registration;
use App\Device;
use PushNotification;

class ContributionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $conts = Contribution::join('registration', 'registration.registrationId', '=', 'contribution.userId')
                ->paginate(10);
        return view('contributions.index', compact('conts'));
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
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    public function addContribution() {
        return view('contributions.addContribution');
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

    public function getUserContributions(Request $request) {
        $data = Contribution::join('investment', 'investment.contributionId', '=', 'contribution.contribution')
                        ->where(['contribution.userId' => $request->id, 'investment.contributionId'])->get();
        return response()->json($data);
    }

    public function showContribution(Request $request) {

        if ($request->ajax()) {
            return response(Contribution::join('registration', 'registration.registrationId', '=', 'contribution.userId')
                            ->find($request->contributionId));
        }
    }

}
