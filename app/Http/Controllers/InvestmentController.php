<?php

namespace App\Http\Controllers;

use App\Contribution;
use App\Investment;
use App\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InvestmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invests = Investment::join('contribution', 'contribution.contributionId', '=', 'investment.contributionId')
            ->join('registration', 'registration.registrationId', '=', 'contribution.userId')
            ->paginate(10);
        return view('investments.index', compact('invests'));
    }

    public function create()
    {

    }

    public function createInvestment()
    {
        $regs = Registration::all();
        return view('investments.addInvestment', compact('regs'));
    }

    public function postInvestments(Request $request)
    {
        //return $request->all();
        try {
            Investment::create($request->all());
            Contribution::where('contributionId', $request->contributionId)->update(array('isInvested' => 1));
            return back()->with(['success' => 'Investment saved successfully']);
        } catch (\Illuminate\Database\QueryException $ex) {
            Log::error($ex);
        }
    }

    public function store(Request $request)
    {

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

    public function getInvestments(Request $request)
    {

        $invests = Investment::join('contribution', 'contribution.contributionId', '=', 'investment.contributionId')
            ->join('registration', 'registration.registrationId', '=', 'contribution.userId')
            ->select('contribution.contributionAmount as amount', 'investment.interestRate as rate', 'investment.dateOfInvestment as dateOfInvestment')
            ->where('registration.email', '=', $request->email)->get();

        return response()->json($invests);
    }

    public function getHeaderSummary(Request $request)
    {
        $openingBalance = 0.00;
        $result = Contribution::join('registration', 'registration.registrationId', '=', 'contribution.userId')
            ->select('contribution.contributionAmount as contributionAmount', 'contribution.created_at as created_at')
            ->where('registration.email', '=', $request->email)
            ->where('contribution.isApproved', '=', 1)
            ->orderBy('created_at', 'DESC')
            ->first();
        if ($result != null) {
            $openingBalance = $result->contributionAmount;
        }

        $totalContributions = Contribution::join('registration', 'registration.registrationId', '=', 'contribution.userId')
            ->select('contribution.contributionAmount as contributionAmount', 'contribution.created_at as created_at')
            ->where('registration.email', '=', $request->email)
            ->where('contribution.isApproved', '=', 1)
            ->sum('contributionAmount');

        $totalInterest = Contribution::join('registration', 'registration.registrationId', '=', 'contribution.userId')
            ->select('contribution.contributionAmount as contributionAmount', 'contribution.created_at as created_at')
            ->where('registration.email', '=', $request->email)
            ->where('contribution.isApproved', '=', 1)
            ->sum('contributionAmount');

        $data = ['openingBalance' => $openingBalance, 'totalContributions' => $totalContributions, 'totalInterest' => $totalInterest];
        return response()->json($data);
    }

}
