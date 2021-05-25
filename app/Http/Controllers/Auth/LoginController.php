<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
// use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $valid = $this->validateLogin($request->all());

        if ($valid->fails()){
            return response()->json(['errors' => $valid->errors()], 401);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
       
        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(array $data)
    {

        return Validator::make($data, [
            $this->username() => ['bail', 'required', 'string', 'email'],
            'password' => ['bail', 'required', 'string', 'min:8'],
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        $this->credentials($request);

        $user = User::where('email', $request->email)->first();

        if (! $user || !Hash::check($request->password, $user->password)){
           return false;
        }

        return true;
    }
    
    // protected function guard()
    // {
    //     return Auth::guard();
    // }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    protected function sendLoginResponse(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        return $this->authenticated($user);
        // if($this->guard()->user()->verified){
        //     return $this->authenticated($request, $this->guard()->user());
        // }
        // $warning = ['unverified_email' => 'please confirm your account. An email has been sent to you'];
        // return response()->json(['warning' => $warning]);
    }

    protected function authenticated($user)
    {
        $token = $user->createToken('laravel8Token')->plainTextToken;

        return response()->json(['data' => $user, 'token'=>$token], 200);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        // throw ValidationException::withMessages([
        //     $this->username() => ['Unauthorized. Invalid email or password']
        // ]);
        // $error = ['auth_failed'=>'Unauthorized. Invalid email or password'];
        // return response()->json(['error'=> $error]);

        return throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

     public function username()
    {
        return 'email';
    }
}