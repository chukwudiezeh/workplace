<?php

namespace App\Http\Controllers;

use App\Http\Resources\FreelancerResource;
use App\Http\Resources\FreelanceResource;
use Illuminate\Http\Request;
use App\Models\Freelancer;
use App\Models\jobInvites;
use App\Models\User;
use App\Models\Client;
class FreelancerController extends Controller
{

    public function updateFreelancer(Request $request, Freelancer $freelancer){
        $freelancer->overview = $request->overview;
        $freelancer->address = $request->address;
        $freelancer->experience_level_id = $request->experience_level_id;
        $freelancer->category_id = $request->category_id;
        $freelancer->subcategory_id = $request->subcategory_id;
        $freelancer->hourly_rate = $request->hourly_rate;
        $freelancer->save();

        return response()->json(['message'=> 'Basic Information Saved']);

    }
    //client
    public function index()
    {
        $freelancers = User::where('user_type_id',1)->get(); //TODO

        return FreelancerResource::collection($freelancers);
    }
    public function recommended()
    {
        $freelancers = Freelancer::where([['category_id','=',1], ['job_success_rate', '>=', 70 ]])->inRandomOrder()->limit(5)->get(); //TODO

        return FreelanceResource::collection($freelancers);
    }
    public function showFreelancer(Freelancer $freelancer)
    {
        return response()->json(['data' => $freelancer], 200);
    }

    public function sendInvite(Request $request,Client $client, Freelancer $freelancer)
    {
        $job_invite = new jobInvites;
        $job_invite->message = $request->message;
        $job_invite->job_id = $request->job_id;
        $job_invite->freelancer_id = $freelancer->id;
        $job_invite->client_id = $client->id;
        $job_invite->save();

        return response()->json(['message' => 'Job Invite Sent'],200);
    }




}
