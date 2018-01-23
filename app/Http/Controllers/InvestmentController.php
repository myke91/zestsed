<?php

namespace App\Http\Controllers;

use App\Contribution;
use App\Investment;
use App\Registration;
use Carbon\Carbon;
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
        $invests = Investment::join('registration', 'registration.registrationId', '=', 'investment.memberId')
            ->where(['quotaMonth' => date('M'), 'quotaYear' => date('Y')])
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

        $invests = Investment::join('registration', 'registration.registrationId', '=', 'investment.memberId')
            ->where('registration.email', '=', $request->email)
            ->orderBy('investment.created_at', 'DESC')
            ->get();

        return response()->json($invests);
    }

    public function getHeaderSummary(Request $request)
    {
        $openingBalance = 0.00;
        $result = Contribution::join('registration', 'registration.registrationId', '=', 'contribution.memberId')
            ->select('contribution.contributionAmount as contributionAmount', 'contribution.created_at as created_at')
            ->where('registration.email', '=', $request->email)
            ->where('contribution.isApproved', '=', 1)
            ->orderBy('created_at', 'DESC')
            ->first();
        if ($result != null) {
            $openingBalance = $result->contributionAmount;
        }

        $totalContributions = Contribution::join('registration', 'registration.registrationId', '=', 'contribution.memberId')
            ->select('contribution.contributionAmount as contributionAmount', 'contribution.created_at as created_at')
            ->where('registration.email', '=', $request->email)
            ->where('contribution.isApproved', '=', 1)
            ->sum('contributionAmount');

        $totalInterest = Investment::join('registration', 'registration.registrationId', '=', 'investment.memberId')
            ->select('cumulativeInterest')
            ->where('registration.email', '=', $request->email)
            ->sum('cumulativeInterest');

        $data = ['openingBalance' => $openingBalance, 'totalContributions' => $totalContributions, 'totalInterest' => $totalInterest];
        return response()->json($data);
    }

    public function getInvestmentsForPeriod(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        $invests = Investment::join('registration', 'registration.registrationId', '=', 'investment.memberId')
            ->where(['quotaMonth' => $month, 'quotaYear' => $year])->paginate(0);
        return response()->json($invests);
    }

    public function processEndOfMonthOperation(Request $request)
    {
        for ($i = 0; $i < count($request->batch); $i++) {
            $id = $request->batch[$i];
            try {
                $investment = Investment::find($id);
                if ($investment->quotaRollover == 0.00) {
                    $interest = 0.04 * $investment->quotaAmount;
                    $investment->interestAmount = $interest;
                    $date = Carbon::createFromFormat('Y-M-d', $investment->quotaYear . '-' . $investment->quotaMonth . '-10');
                    $nextCycleDate = $date->addMonth();
                    $investment->cycleMonth = $nextCycleDate->format('M');
                    $investment->cycleYear = $nextCycleDate->year;
                    $investment->quotaRollover = $investment->quotaAmount + $interest;
                    $investment->quotaWithInterest = $investment->quotaAmount + $interest;
                    $investment->cumulativeInterest = $investment->cumulativeInterest + $interest;
                    $investment->save();
                } else {
                    $interest = 0.04 * $investment->quotaRollover;
                    $investment->interestAmount = $interest;
                    $date = Carbon::createFromFormat('Y-M-d', $investment->cycleYear . '-' . $investment->cycleMonth . '-10');
                    $nextCycleDate = $date->addMonth();
                    $investment->cycleMonth = $nextCycleDate->format('M');
                    $investment->cycleYear = $nextCycleDate->year;
                    $investment->quotaRollover = $investment->quotaRollover + $interest;
                    $investment->quotaWithInterest = $investment->quotaRollover + $interest;
                    $investment->cumulativeInterest = $investment->cumulativeInterest + $interest;
                    $investment->save();
                }
            } catch (\Exception $ex) {
                Log::debug($ex);
                return response()->json($ex, 500);
            }
        }
    }
}
