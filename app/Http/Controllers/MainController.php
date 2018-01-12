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

}
