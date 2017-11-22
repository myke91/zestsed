<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Investment;
use App\Registration;

class InvestmentController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $invests = Investment::join('contribution', 'contribution.contributionId', '=', 'investment.contributionId')
                ->join('registration', 'registration.registrationId', '=', 'contribution.userId')
                ->paginate(10);
        return view('investments.index', compact('invests'));
    }

    public function create() {

    }
    public function createInvestment()
    {
        $regs = Registration::all();
        return view('investments.addInvestment',compact('regs'));
    }
    public function postInvestments(Request $request) {
        //return $request->all();
        Investment::create($request->all());
        return back()->with(['success'=>'Investment saved successfully']);
    }


    public function store(Request $request) {

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
