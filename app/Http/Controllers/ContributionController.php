<?php

namespace App\Http\Controllers;

use App\Contribution;
use App\Device;
use App\Investment;
use App\Registration;
use Illuminate\Http\Request;
use PushNotification;
use \Illuminate\Support\Facades\Log;
use \Illuminate\Support\Facades\Redirect;

class ContributionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conts = Contribution::join('registration', 'registration.registrationId', '=', 'contribution.memberId')
            ->select('contribution.contributionId', 'registration.firstName as firstName', 'registration.otherNames', 'registration.lastName as lastName',
                'contribution.contributionAmount as contributionAmount', 'contribution.vendorName as vendorName', 'contribution.dateOfContribution as dateOfContribution',
                'contribution.modeOfPayment as modeOfPayment', 'contribution.isApproved as isApproved')
            ->orderBy('contribution.created_at','DESC')
            ->orderBy('isApproved','DESC')
            ->paginate(10);
        return view('contributions.index', compact('conts'));
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
        Log::debug($request);
        try {
            Contribution::create($request->all());
            return back()->with(['success' => 'Contribution saved successfully']);
        } catch (\Exception $ex) {
            return back()->with(['error' => 'Error while saving contribution']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contrib = Contribution::join('registration', 'registration.registrationId', 'contribution.memberId')
            ->select("contributionId", "modeOfPayment", "sourceOfPayment", "vendorName", "dateOfContribution", "contributionAmount", "contribution.isApproved",
                "contribution.dateOfApproval", "isInvested", "memberId", "registrationId", "firstName", "lastName", "otherNames")
            ->where('contributionId', $id)
            ->first();
        Log::debug($contrib);
        return view('contributions.editContribution', compact('contrib'));
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
        if (Contribution::find($id)->isApproved != 1) {
            try {
                Contribution::updateOrCreate(['contributionId' => $id], $request->all());
                return back()->with(['success' => 'Contribution updated successfully']);
            } catch (\Exception $ex) {
                return back()->with(['error' => 'Error while updating contribution']);
            }
        }
        return back()->with(['error' => 'Contribution already approved. Cannot be edited.']);

    }

    public function addContribution()
    {
        $regs = Registration::orderBy('firstName', 'ASC')->get();
        return view('contributions.addContribution', compact('regs'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::debug($id);
        Log::debug(Contribution::find($id));
        Log::debug(Contribution::find($id)->isApproved);
        if (Contribution::find($id)->isApproved != 1) {
            try {
                Log::debug('going to delete');
                Contribution::destroy($id);
                return response()->json(['message' => 'Success'], 200);
            } catch (\Exception $ex) {
                return response()->json($ex, 500);
            }
        }
        Log::debug('not deleting');
        return response()->json(['message' => "Contribution has already been approved."], 403);
    }

    public function saveContribution(Request $request)
    {
        Log::debug($request);
        Log::info('calling save contribution from mobile application for -- ' . $request->userEmail);
        try {
            $user = Registration::where('email', $request->userEmail)->first();
            $id_array = ["memberId" => $user->registrationId];
            $data = array_merge($id_array, $request->all());

            Log::debug($data);

            Contribution::create($data);
            Log::info('save successful');

            return response()->json(['success' => 'SAVE SUCCESSFUL'], 200);
        } catch (Exception $ex) {
            Log::info('save error' . $ex->getMessage());
            return response()->json(['error' => 'An error occured while saving your registration \n' . $ex->getMessage()], 500);
        }
    }

    public function approveContribution($id)
    {
        try {
            $contribution = Contribution::find($id);
            $contribution->isApproved = true;
            $contribution->isInvested = true;
            $contribution->dateOfApproval = date('Y-m-d');

            $user = Registration::find($contribution->memberId);
            $contribution->save();

            $investment = new Investment();

            $investment->memberId = $user->registrationId;
            $investment->quotaMonth = date('M');
            $investment->quotaYear = date('Y');
            $investment->quotaAmount = $contribution->contributionAmount;
            $investment->save();

            $device = Device::where('email', $user->email)->first();
            PushNotification::app('android')
                ->to($device->deviceToken)
                ->send("Your contribution of $contribution->contributionAmount on $contribution->dateOfContribution has been approved.");
            return Redirect::action('ContributionController@index');
        } catch (Exception $ex) {
            $messages = ['error' => 'ERROR APROVING CONTRIBUTION' . $ex->getMessage()];
            return Redirect::action('ContributionController@index')->withErrors($messages);
        }
    }

    public function getContributions(Request $request)
    {
        Log::info('calling get contributions ' . $request->email);
        $user = Registration::where('email', $request->email)->first();
        $data = Contribution::where(['memberId' => $user->registrationId, 'isApproved' => 1])->get();
        Log::debug($data);
        return response()->json($data, 200);
    }

    public function getUserContributions(Request $request)
    {
        $data = Contribution::join('registration', 'registration.registrationId', '=', 'contribution.memberId')
            ->where(['registration.registrationId' => $request->id, 'contribution.isApproved' => 1])->get();

        return response()->json($data);
    }

    public function showContribution(Request $request)
    {
        if ($request->ajax()) {
            return response(Contribution::join('registration', 'registration.registrationId', '=', 'contribution.memberId')
                    ->find($request->contributionId));
        }
    }

    public function getContributionsForPeriod(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        $conts = Contribution::join('registration', 'registration.registrationId', '=', 'contribution.memberId')
            ->select("contributionId", "modeOfPayment", "sourceOfPayment", "vendorName", "dateOfContribution", "contributionAmount", "contribution.isApproved",
                "contribution.dateOfApproval", "isInvested", "memberId", "registrationId", "firstName", "lastName", "otherNames")
            ->whereMonth('dateOfContribution', $month)
            ->whereYear('dateOfContribution', $year)
            ->orderBy('dateOfContribution','ASC')
            ->get();
            Log::debug($conts);
        return response()->json($conts);
    }

}
