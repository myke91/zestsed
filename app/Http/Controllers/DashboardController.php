<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registration;
use App\Contribution;
use App\Investment;
use View;

class DashboardController extends Controller {

    public function index() {
        $totalRegistrations = Registration::all()->count();
        $approvedContributions = Contribution::where(['isApproved' => 1])->count();
        $investmentsMake = Investment::all()->count();
        return View::make('main')
                        ->with(compact('totalRegistrations'))
                        ->with(compact('approvedContributions'))
                        ->with(compact('investmentsMade'));
    }

}
