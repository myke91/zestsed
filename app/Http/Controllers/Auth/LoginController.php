<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use \Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Response;
use \Illuminate\Support\Facades\Log;
use \Illuminate\Support\Facades\DB;

class LoginController extends Controller {
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
    public function __construct() {
        
    }

    public function mobileLogin(Request $request) {
        Log::info('Received login request for user with email ' . $request->get('email'));
        $email = $request->get('email');
        $password = $request->get('password');

        $user = User::where('email', trim($email))->first();

        if (!is_null($user)) {
            Log::debug($user);
            if ($user->password != '') {
                if (Hash::check($password, $user->password)) {
                    Log::info('LOGIN SUCCESSFUL');

                    return response()->json(['success' => "SUCCESS"], 200);
                }
                Log::info('INVALID PASSWORD');
                return Response::json(["error" => "INVALID PASSWORD"], 401);
            }
            return response()->json(['success' => 'FIRST TIME LOGIN'], 200);
        }
        Log::error('USER NOT FOUND');
        return Response::json(["error" => "USER NOT FOUND"], 401);
    }

    public function setPassword(Request $request) {
        try {
            DB::table('users')
                    ->where('email', $request->email)
                    ->update(['password' => bcrypt($request->password)]);
            return response()->json(['success' => 'Request successful'], 200);
        } catch (Exception $ex) {
            return response()->json(['error' => 'Error occured while setting new password'], 500);
        }
    }

    public function refresh() {
        return response($this->loginProxy->attemptRefresh());
    }

    public function logout() {
        $this->loginProxy->logout();
        return response(null, 204);
    }

}
