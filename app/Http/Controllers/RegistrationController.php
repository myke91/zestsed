<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;
use PushNotification;
use \App\Device;
use \App\User;
use \Illuminate\Support\Facades\Log;
use \Illuminate\Support\Facades\Redirect;

class RegistrationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regs = Registration
        ::orderBy('created_at','DESC')
        ->orderBy('isApproved','DESC')
        ->paginate(10);
        return view('registrations.index', compact('regs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($registrationId)
    {
        $reg = Registration::findOrFail($registrationId);

        return view('registrations.show', Compact('reg'));
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function saveRegistration(Request $request)
    {
        Log::info('calling save registration from mobile application -- ' . $request->email);
        try {
            Log::debug($request->all());
            Registration::create($request->all());
            Log::info('save successful');

            return response()->json(['success' => 'SAVE SUCCESSFUL'], 200);
        } catch (\Illuminate\Database\QueryException $ex) {
            Log::info('save error'. $ex->getMessage());
            return response()->json(['error' => 'An error occured while saving your registration \n' . $ex->getMessage()], 500);
        }
    }

    public function approveRegistration($id)
    {
        try {
            $customer = Registration::find($id);
            $customer->isApproved = true;
            $customer->dateOfApproval = date('Y-m-d');
            Log::debug('approving registration');
            User::insert([
                'email' => $customer->email,
                'username' => $customer->firstName . '.' . $customer->lastName,
                'name' => $customer->firstName . ' ' . $customer->otherNames . ' ' . $customer->lastName,
                'type' => 'mobile',
            ]);
            $customer->save();
            $device = Device::where('email', $customer->email)->first();
            PushNotification::app('android')
                ->to($device->deviceToken)
                ->send("Your registration has been approved. \n Login with your email and any password to set a password");
            return Redirect::action('RegistrationController@index');
        } catch (\Illuminate\Database\QueryException $ex) {
            Log::debug($ex);
            $messages = ['error' => 'ERROR APROVING REGISTRATION' . $ex->getMessage()];
            return Redirect::action('RegistrationController@index')->withErrors($messages);
        }
    }

    public function registerDevice(Request $request)
    {
        if (is_null(Device::where(['email' => $request->email])->first())) {
            Log::info('calling register device from mobile application -- ' . $request->email);
            if ($request->token != null || $request->token != '') {
                try {
                    $user = Registration::where('email', $request->email)->first();
                    $data = [
                        'deviceToken' => $request->token,
                        'email' => $request->email,
                        'userId' => $user->registrationId,
                    ];
                    Device::updateOrCreate(['email' => $request->email], $data);
                    Log::info('device registration successful');
                    return response()->json(['success' => 'DEVICE REGISTRATION SUCCESSFUL'], 200);
                } catch (\Illuminate\Database\QueryException $ex) {
                    Log::info('save error'. $ex->getMessage());
                    return response()->json(['error' => 'An error occured while registering your device \n' . $ex->getMessage()], 500);
                }
            }
        } else {
            return response()->json(['message' => 'Device already registered'], 200);
        }
    }

    public function showRegistration(Request $request)
    {

        if ($request->ajax()) {
            return response(Registration::find($request->registrationId));
        }
    }

    public function getRegistrationsForPeriod(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        $regs = Registration::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)->get();
        return response()->json($regs);
    }

}
