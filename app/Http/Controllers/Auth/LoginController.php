<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Registration;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Log;
use \Illuminate\Support\Facades\Response;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function mobileLogin(Request $request)
    {
        Log::info('Received login request for user with email ' . $request->get('email'));
        $email = $request->get('email');
        $password = $request->get('password');

        $user = User::where('email', trim($email))->first();
        Log::debug($user);
        Log::debug("check password exist ".isset($user->password));

        if (!is_null($user)) {
            if (isset($user->password)) {
                if (Hash::check($password, $user->password)) {
                    Log::info('LOGIN SUCCESSFUL');
                    return response()->json(['success' => "SUCCESS"], 200);
                }
                Log::info('INVALID PASSWORD');
                return Response::json(["error" => "INVALID PASSWORD"], 401);
            }
            return response()->json(['success' => 'FIRST TIME LOGIN'], 200);
        }else if(!is_null(Registration::where('email', trim($email))->first())){
        Log::error('USER REGISTRATION NOT APPROVED');
        return Response::json("Your registration may not have been approved yet, if you entered the right email.\n Kindly contact ZestSed office.", 401);
        }
        Log::error('USER NOT FOUND');
        return Response::json("ACCOUNT DOES NOT EXIST.", 401);
    }

    public function setPassword(Request $request)
    {
        try {
            DB::table('users')
                ->where('email', $request->email)
                ->update(['password' => bcrypt($request->password)]);
            return response()->json(['success' => 'Request successful'], 200);
        } catch (Exception $ex) {
            return response()->json('Error occured while setting new password', 500);
        }
    }

    public function refresh()
    {
        return response($this->loginProxy->attemptRefresh());
    }

//    public function logout() {
    //        $this->loginProxy->logout();
    //        return response(null, 204);
    //    }

}
