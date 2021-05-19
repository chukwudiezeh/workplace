<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Freelancer;


class RegisterController extends Controller
{
    

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    /*
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validatr = $this->validator($request->all());

        if ($validatr->fails()){
             return response()->json(['errors' => $validatr->errors()], 401);
        }

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        return $this->registered($request, $user);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['bail','required', 'string','alpha', 'max:50'],
            'lastname' => ['bail', 'required', 'string', 'max:50'],
            'phone' => ['bail', 'required','string', 'unique:users'],
            'email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:users'],
            'user_type_id' =>['required', 'numeric'],
            'password' => ['bail', 'required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'user_type_id' => $data['user_type_id'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        if ($user->user_type_id == 1){
            $freelancer = new Freelancer;
            $freelancer->user_id = $user->id;

            $freelancer->save();
        }else{
            $client = new Client;
            $client->user_id = $user->id;

            $client->save();
        }

        $message = ['status'=>'Success','body'=>'You have successfully being registered. please check your email.'];
        return response()->json(['user' => $user, 'message' => $message], 201);
    }
}
