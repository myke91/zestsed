<?php

namespace App\Http\Controllers;

use App\Contribution;
use App\Investment;
use App\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Log;

class MainController extends Controller
{

    public function dashboard()
    {
        $registration = Registration::where('isApproved', 1)->get()->count();
        $contribution = Contribution::where('isApproved', 1)->get()->count();
        $investment = Investment::get()->count();

        $conts = Contribution::join('registration', 'registration.registrationId', '=', 'contribution.contributionId')
            ->paginate(10);

        $invests = Investment::join('contribution', 'contribution.contributionId', '=', 'investment.contributionId')
            ->join('registration', 'registration.registrationId', '=', 'contribution.userId')
            ->paginate(10);
        return view('main', compact('registration', 'contribution', 'investment', 'conts', 'invests'));
    }

    public function getUserDetails(Request $request)
    {
        try {
            Log::debug('Loading user profile details');
            return response()->json(Registration::where('email', '=', $request->email)->first(), 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => 'Unable to retrieve user details' . $ex->getMessage()], 500);
        }
    }

    public function overviewGraphData()
    {
        $query = 'SELECT MONTHNAME(created_at) , COUNT(registrationId) '
            . 'FROM `registration` WHERE created_at >= NOW() - INTERVAL 1 YEAR '
            . 'GROUP BY MONTH(created_at)';
        DB::query($query);
    }

    public function updateProfilePicture(Request $request)
    {
        Log::info('Updating user profile image for user ' . $request->email);
        $imageData = $request->image;
        $email = $request->email;

        try {
            $profile = Registration::where('email', '=', $email)->first();
            $profile->image = $imageData;
            $profile->save();
            Log::info('Updating user profile image successful');
            return response()->json(['success' => 'Image update successful'], 200);
        } catch (\Exception $ex) {
            Log::info('Updating user profile image failed');
            Log::error($ex);
            return response()->json(['error' => 'Image update failed'], 500);
        }

    }

}
