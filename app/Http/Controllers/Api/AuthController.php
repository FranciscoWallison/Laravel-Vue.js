<?php

namespace CodeFin\Http\Controllers\Api;

use CodeFin\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    use AuthenticatesUsers;

  
    public function __construct()
    {
     
    }


    public function accessToken(Request $request)
    {
    	$this->validateLogin($request);

    	$credentials = $this->credentials($request);

    	if($token = Auth::guard('api')->attempt($credentials))
    	{
    		// retornar o token
    		return $this->sendLoginResponse($request, $token);

    	}
    }


    protected function sendLoginResponse(Request $request, $token)
    {
    	return response()->json([
    		'token' => $token
    	]);
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
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect(env('URL_ADMIN_LOGIN'));
    }
}
