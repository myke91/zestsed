<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registration;
use App\Contribution;
use App\Investment;

class MainController extends Controller {

    public function dashboard() {
        $registration = Registration::get()->count();
        $contribution = Contribution::get()->count();
        $investment = Investment::get()->count();

        $conts = Contribution::join('registration', 'registration.registrationId', '=', 'contribution.contributionId')
                ->paginate(10);

        $invests = Investment::join('contribution', 'contribution.contributionId', '=', 'investment.investmentId')
                ->join('registration', 'registration.registrationId', '=', 'contribution.contributionId')
                ->paginate(10);
        return view('main', compact('registration', 'contribution', 'investment', 'conts', 'invests'));
    }

}
