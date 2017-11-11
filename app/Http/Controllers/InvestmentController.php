<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvestmentController extends Controller {

    public function investments() {
        return view('investments.index');
    }

    public function saveInvestment(Request $request) {
        
    }

}
