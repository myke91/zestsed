<?php

namespace App\Http\Controllers;

use App\Contribution;
use App\Investment;
use App\Registration;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Excel;
use \Illuminate\Support\Facades\Log;

class MainController extends Controller
{

    public function dashboard()
    {
        $registration = Registration::where('isApproved', 1)->get()->count();
        $contribution = Contribution::where('isApproved', 1)->get()->count();
        $investment = Investment::get()->count();

        $conts = Contribution::join('registration', 'registration.registrationId', '=', 'contribution.contributionId')
            ->orderBy('contribution.dateOfContribution', 'DESC')
            ->paginate(10);

        $invests = Investment::join('registration', 'registration.registrationId', '=', 'investment.memberId')
            ->orderBy('investment.created_at', 'DESC')
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

    public function overviewGraphData(Request $request)
    {
        $contributions = array();
        $investments = array();

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where MONTHNAME(invoice_header.created_at) = "January" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $firstMonth = ["period" => "Jan",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $firstMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "February" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $secondMonth = ["period" => "Feb",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $secondMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "March" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $thirdMonth = ["period" => "Mar",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $thirdMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "April" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $fourthMonth = ["period" => "Apr",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $fourthMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "May" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $fifthMonth = ["period" => "May",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $fifthMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "June" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $sixthMonth = ["period" => "Jun",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $sixthMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "July" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $seventhMonth = ["period" => "Jul",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $seventhMonth);

        $eightMonth = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "August" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $eightMonth = ["period" => "Aug",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $eightMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "September" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $ninthMonth = ["period" => "Sep",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $ninthMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "October" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $tenthMonth = ["period" => "Oct",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $tenthMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "November" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $eleventhMonth = ["period" => "Nov",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $eleventhMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "December" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $twelvethMonth = ["period" => "Dec",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];
        array_push($data, $twelvethMonth);

        Log::debug($data);
        return response()->json($data);
    }

    public function migrateData(Request $request)
    {
        $data = Excel::load('storage\app\WEALTH CREATORS DATABASE 2017.xlsx', function ($reader) {})->get();

        foreach ($data as $key => $value) {
            Log::debug($value);
            Log::debug($value->email_address);
            $registration = new Registration();
            $registration->isApproved = 1;
            $registration->email = $value->email_address;
            $registration->firstName = explode(' ', $value->names)[0];
            $registration->lastName = explode(' ', $value->names)[1];
            $registration->dateOfBirth = date('Y-m-d');
            $registration->dateOfApproval = date('Y-m-d');
            $registration->save();
            $member = Registration::where(['email' => $value->email_address])->first();
            Log::debug('logging member ');
            Log::debug($member);

            $user = new User();
            $user->email = $value->email_address;
            $user->name = $value->names;
            $user->username = $value->names;
            $user->type = 'mobile';
            $user->save();
            Log::debug('logging user');

            if ($value->january_to_march != null) {
                $contribution = new Contribution();
                $contribution->memberId = $member->registrationId;
                $contribution->modeOfPayment = "SELF";
                $contribution->sourceOfPayment = "SELF";
                $contribution->vendorName = "VENDOR";
                $contribution->dateOfContribution = '2017-03-10';
                $contribution->isApproved = 1;
                $contribution->contributionAmount = $value->january_to_march;
                $contribution->dateOfApproval = date('Y-m-d');
                $contribution->isInvested = 1;
                $contribution->save();

                $investment = new Investment();
                $investment->memberId = $member->registrationId;
                $investment->quotaMonth = 'Mar';
                $investment->quotaYear = '2017';
                $investment->quotaAmount = $value->january_to_march;
                $investment->save();

                Log::debug('Saved for march');
            }

            if ($value->april != null) {
                $contribution = new Contribution();
                $contribution->memberId = $member->registrationId;
                $contribution->modeOfPayment = "SELF";
                $contribution->sourceOfPayment = "SELF";
                $contribution->vendorName = "VENDOR";
                $contribution->dateOfContribution = '2017-04-10';
                $contribution->isApproved = 1;
                $contribution->contributionAmount = $value->april;
                $contribution->dateOfApproval = date('Y-m-d');
                $contribution->isInvested = 1;
                $contribution->save();

                $investment = new Investment();
                $investment->memberId = $member->registrationId;
                $investment->quotaMonth = 'Apr';
                $investment->quotaYear = '2017';
                $investment->quotaAmount = $value->april;
                $investment->save();

                Log::debug('Saved for april');
            }

            if ($value->may != null) {
                $contribution = new Contribution();
                $contribution->memberId = $member->registrationId;
                $contribution->modeOfPayment = "SELF";
                $contribution->sourceOfPayment = "SELF";
                $contribution->vendorName = "VENDOR";
                $contribution->dateOfContribution = '2017-05-10';
                $contribution->isApproved = 1;
                $contribution->contributionAmount = $value->may;
                $contribution->dateOfApproval = date('Y-m-d');
                $contribution->isInvested = 1;
                $contribution->save();

                $investment = new Investment();
                $investment->memberId = $member->registrationId;
                $investment->quotaMonth = 'May';
                $investment->quotaYear = '2017';
                $investment->quotaAmount = $value->may;
                $investment->save();

                Log::debug('Saved for may');
            }

            if ($value->june != null) {
                $contribution = new Contribution();
                $contribution->memberId = $member->registrationId;
                $contribution->modeOfPayment = "SELF";
                $contribution->sourceOfPayment = "SELF";
                $contribution->vendorName = "VENDOR";
                $contribution->dateOfContribution = '2017-06-10';
                $contribution->contributionAmount = $value->june;
                $contribution->isApproved = 1;
                $contribution->dateOfApproval = date('Y-m-d');
                $contribution->isInvested = 1;
                $contribution->save();

                $investment = new Investment();
                $investment->memberId = $member->registrationId;
                $investment->quotaMonth = 'Jun';
                $investment->quotaYear = '2017';
                $investment->quotaAmount = $value->june;
                $investment->save();

                Log::debug('Saved for june');
            }

            if ($value->july != null) {
                $contribution = new Contribution();
                $contribution->memberId = $member->registrationId;
                $contribution->modeOfPayment = "SELF";
                $contribution->sourceOfPayment = "SELF";
                $contribution->vendorName = "VENDOR";
                $contribution->dateOfContribution = '2017-07-10';
                $contribution->contributionAmount = $value->july;
                $contribution->isApproved = 1;
                $contribution->dateOfApproval = date('Y-m-d');
                $contribution->isInvested = 1;
                $contribution->save();

                $investment = new Investment();
                $investment->memberId = $member->registrationId;
                $investment->quotaMonth = 'Jul';
                $investment->quotaYear = '2017';
                $investment->quotaAmount = $value->july;
                $investment->save();

                Log::debug('Saved for july');
            }

            if ($value->august != null) {
                $contribution = new Contribution();
                $contribution->memberId = $member->registrationId;
                $contribution->modeOfPayment = "SELF";
                $contribution->sourceOfPayment = "SELF";
                $contribution->vendorName = "VENDOR";
                $contribution->dateOfContribution = '2017-08-10';
                $contribution->isApproved = 1;
                $contribution->contributionAmount = $value->august;
                $contribution->dateOfApproval = date('Y-m-d');
                $contribution->isInvested = 1;
                $contribution->save();

                $investment = new Investment();
                $investment->memberId = $member->registrationId;
                $investment->quotaMonth = 'Aug';
                $investment->quotaYear = '2017';
                $investment->quotaAmount = $value->august;
                $investment->save();

                Log::debug('Saved for august');
            }

            if ($value->sept != null) {
                $contribution = new Contribution();
                $contribution->memberId = $member->registrationId;
                $contribution->modeOfPayment = "SELF";
                $contribution->sourceOfPayment = "SELF";
                $contribution->vendorName = "VENDOR";
                $contribution->dateOfContribution = '2017-09-10';
                $contribution->isApproved = 1;
                $contribution->contributionAmount = $value->sept;
                $contribution->dateOfApproval = date('Y-m-d');
                $contribution->isInvested = 1;
                $contribution->save();

                $investment = new Investment();
                $investment->memberId = $member->registrationId;
                $investment->quotaMonth = 'Sep';
                $investment->quotaYear = '2017';
                $investment->quotaAmount = $value->sept;
                $investment->save();

                Log::debug('Saved for september');
            }

            if ($value->oct != null) {
                $contribution = new Contribution();
                $contribution->memberId = $member->registrationId;
                $contribution->modeOfPayment = "SELF";
                $contribution->sourceOfPayment = "SELF";
                $contribution->vendorName = "VENDOR";
                $contribution->dateOfContribution = '2017-10-10';
                $contribution->isApproved = 1;
                $contribution->contributionAmount = $value->oct;
                $contribution->dateOfApproval = date('Y-m-d');
                $contribution->isInvested = 1;
                $contribution->save();

                $investment = new Investment();
                $investment->memberId = $member->registrationId;
                $investment->quotaMonth = 'Oct';
                $investment->quotaYear = '2017';
                $investment->quotaAmount = $value->oct;
                $investment->save();

                Log::debug('Saved for october');
            }

            if ($value->nov != null) {
                $contribution = new Contribution();
                $contribution->memberId = $member->registrationId;
                $contribution->modeOfPayment = "SELF";
                $contribution->sourceOfPayment = "SELF";
                $contribution->vendorName = "VENDOR";
                $contribution->dateOfContribution = '2017-11-10';
                $contribution->isApproved = 1;
                $contribution->contributionAmount = $value->nov;
                $contribution->dateOfApproval = date('Y-m-d');
                $contribution->isInvested = 1;
                $contribution->save();

                $investment = new Investment();
                $investment->memberId = $member->registrationId;
                $investment->quotaMonth = 'Nov';
                $investment->quotaYear = '2017';
                $investment->quotaAmount = $value->nov;
                $investment->save();

                Log::debug('Saved for november');
            }

            if ($value->dec != null) {
                $contribution = new Contribution();
                $contribution->memberId = $member->registrationId;
                $contribution->modeOfPayment = "SELF";
                $contribution->sourceOfPayment = "SELF";
                $contribution->vendorName = "VENDOR";
                $contribution->dateOfContribution = '2017-12-10';
                $contribution->isApproved = 1;
                $contribution->contributionAmount = $value->dec;
                $contribution->dateOfApproval = date('Y-m-d');
                $contribution->isInvested = 1;
                $contribution->save();

                $investment = new Investment();
                $investment->memberId = $member->registrationId;
                $investment->quotaMonth = 'Dec';
                $investment->quotaYear = '2017';
                $investment->quotaAmount = $value->dec;
                $investment->save();

                Log::debug('Saved for december');
            }
        }
        echo 'DATA MIGRATION SUCCESSFUL';
    }

}
