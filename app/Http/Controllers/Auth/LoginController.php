<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use \Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Response;
use \Illuminate\Support\Facades\Log;

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

            if (Hash::check($password, $user->password)) {
                Log::info('LOGIN SUCCESSFUL');

                return response()->json(['sucess' => "SUCCESS"], 200);
            }
            Log::info('INVALID PASSWORD');
            return Response::json(["error" => "INVALID PASSWORD"], 401);
        }
        Log::error('USER NOT FOUND');
        return Response::json(["error" => "USER NOT FOUND"], 401);
    }

    public function refresh() {
        return response($this->loginProxy->attemptRefresh());
    }

    public function logout() {
        $this->loginProxy->logout();
        return response(null, 204);
    }

}
