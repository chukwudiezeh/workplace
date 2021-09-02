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
use Illuminate\Support\Arr;


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
            $random_data = $this->randomData();
            $freelancer->user_id = $user->id;
            $freelancer->overview = $random_data['overview'];
            $freelancer->address = "Lagos, Nigeria";
            $freelancer->experience_level_id = $random_data['exp'];
            $freelancer->category_id = 1;
            $freelancer->subcategory_id = $random_data['sub'];
            $freelancer->hourly_rate = $random_data['hourly_rate'];
            $freelancer->job_success_rate = $random_data['sr'];
            $freelancer->position = $random_data['position'];
            $freelancer->skills = $random_data['skills'];
            $freelancer->earnings = $random_data['earnings'];

            $freelancer->save();
        }else{
            $client = new Client;
            $client->user_id = $user->id;

            $client->save();
        }

        $message = ['status'=>'Success','body'=>'You have successfully being registered. please check your email.'];
        return response()->json(['user' => $user, 'message' => $message], 201);
    }


    protected function randomData(){
        $randoms = [['earnings'=> 400000,'sr'=> 75,'skills'=>'{"a":"Tableau","b": "VBA","c": "Data Visualization", "d": "Python}','sub'=>3,'hourly_rate'=> 19000.00,'exp'=> 3,'position'=> "Data Analyst",'overview'=>"I have 4+ years of experience working with Excel and Tableau. I can automate and optimize Excel spreadsheets to significantly reduce the amount of work you put into them.\n\n I can provide simple solutions for complex problems in any industry. I will work with you to create a custom solution that works for your needs.\n\nLooking forward to the challenges!"],
            ['earnings'=> 90000,'sr'=> 68,'skills'=>'{"a":"PHP","b": "MYSQL","c": "ASP.NET", "d": "ColdFusion", "e": "Web Testing"}','sub'=>1,'hourly_rate'=> 12000.00,'exp'=> 2,'position'=> "Web Developer",'overview'=>"I triple majored in engineering at NCSU with a concentration in programming. I later followed with a Masters in Business with a concentration in small business entrepreneurship.\n\nI've worked in programming and project management for almost 20 years and have worked with some of the largest SEO agencies in the world. I have a lot of experience with WordPress as well as many other platforms and coding languages and feel confident I could build whatever you need."],
            ['earnings'=> 950000,'sr'=> 100,'skills'=>'{"a":"HTML","b": "CSS","c": "PHP", "d": "JQuery"}','sub'=>1,'hourly_rate'=> 10000.00,'exp'=> 3,'position'=> "Software Developer",'overview'=>"I triple majored in engineering at NCSU with a concentration in programming. I later followed with a Masters in Business with a concentration in small business entrepreneurship.\n\nI've worked in programming and project management for almost 20 years and have worked with some of the largest SEO agencies in the world. I have a lot of experience with WordPress as well as many other platforms and coding languages and feel confident I could build whatever you need."],
            ['earnings'=> 1000000,'sr'=> 100,'skills'=>'{"a":"SQL","b": "Database Design","c": "PHP", "d": "JavaScript"}','sub'=>1,'hourly_rate'=> 15000.00,'exp'=> 3,'position'=> "Web Developer",'overview'=>"I want to empower your business not only to save time & money by automating manual processes, but also to make more informed decisions by providing clear, concise reporting.\n\nUsing a low-maintenance database platform called Quick Base, I'm able to do this in a matter of weeks rather than months. Additionally, I would be more than happy to train a member of your staff on how to maintain & make updates to the database--no programming knowledge required, just a computer savvy employee will do the trick!"],
            ['earnings'=> 800000,'sr'=> 83,'skills'=>'{"a":"MariaDB","b": "ReactJs","c": "Node.Js", "d": "MongoDB", "e": "PHP", "f":"Laravel"}','sub'=>3,'hourly_rate'=> 20000.00,'exp'=> 3,'position'=> "Web Developer",'overview'=>"My \"native\" programming language, I've worked with it for over 6 years. I've used it in the front-end with React and Redux, in the back-end for APIs with Node, Express and Hapi.js and for testing automation using Mocha and later on, Jest.\n\nI maintain the Semantic markup, I've experience with Search Engine Optimization. I can ensure consistent performance across multiple browsers and platforms. I often turn to using preprocessors such as Sass. I love PostCSS and I prefer to develop the future-proof CSS."],
            ['earnings'=> 650000,'sr'=> 71,'skills'=>'{"a":"Angular 4","b": "Blockchain","c": "Hyperledger", "d": "ReactJs", "e": "AWS ECS"}','sub'=>2,'hourly_rate'=> 14000.00,'exp'=> 2,'position'=> "FullStack Developer",'overview'=>"I’m a Devcon scholar Alumni at Ethereum Foundation and was selected as one of the top ten scholars in the Devcon scholar program in Osaka 2019. Furthermore, I am a blockchain mentor and reviewer at Udacity, blockchain full-stack developer, Ambassador for ConsenSys Quorum and Status Network, Gitcoin Kernel Fellow, and truffle university alumni with a professional master’s degree in cloud computing networks from Cairo University.\n\nI've worked in programming and project management for almost 20 years and have worked with some of the largest SEO agencies in the world. I have a lot of experience with WordPress as well as many other platforms and coding languages and feel confident I could build whatever you need."],


        ];


        return Arr::random($randoms);
    }
}
