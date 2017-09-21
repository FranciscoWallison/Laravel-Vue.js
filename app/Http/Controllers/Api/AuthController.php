<?php

namespace SisFin\Http\Controllers\Api;

use SisFin\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{

    use AuthenticatesUsers;

  
    public function __construct()
    {
     
    }


    public function accessToken(Request $request)
    {
    	$this->validateLogin($request);

    	// If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

    	$credentials = $this->credentials($request);

    	if($token = Auth::guard('api')->attempt($credentials))
    	{
    		// retornar o token
    		return $this->sendLoginResponse($request, $token);

    	}

    	//Quando acabar as tentativas
    	$this->incrementLoginAttempts($request);

    	return $this->sendFailedLoginResponse($request);
    }

    public function refreshToken(Request $request)
    {
        $token = Auth::guard('api')->refresh();
        return $this->sendLoginResponse($request, $token);
    }

    protected function sendLoginResponse(Request $request, $token)
    {
    	//limpar a sessão
    	$this->clearLoginAttempts($request);

    	return response()->json([
    		'token' => $token
    	]);
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $message = Lang::get('auth.throttle', ['seconds' => $seconds]);

        return response()->json([
        		'message' => $message
        	], 403);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
    	$message = Lang::get('auth.failed');

        return response()->json([
        		'message' => $message
        	], 400);
    }

    /**
     * Overwrite Illuminate\Foundation\Auth\AuthenticatesUsers
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        //Revoga o token
        Auth::guard('api')->logout();

        return response()->json([],204);
    }
}
