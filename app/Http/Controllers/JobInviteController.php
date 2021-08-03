<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobInviteResource;
use Illuminate\Http\Request;
use App\Models\JobInvites;
use App\Models\Client;
use App\Models\Freelancer;

class JobInviteController extends Controller
{
    //freelancers
    public function seeInvites(){

    }

    public function seeOneInvite(){

    }

    public function acceptInvite(){

    }

    public function declineInvite(){

    }


    //clients
    public function createInvite(Client $client, Freelancer $freelancer, Request $request){

        $job_invite = JobInvites::create([
            'job_id' => $request->job_id,
            'freelancer_id' => $freelancer->id,
            'client_id' => $client->id,
            'message' => $request->message,
        ]);

        return new JobInviteResource($job_invite);
    }

    public function seeMyInvites(Client $client){
        $my_invites = JobInvites::where('client_id', $client->id)->get();

        return response()->json(['data' => $my_invites], 200);

    }

    public function seeMyOneInvite(){

    }

    public function updateMyInvite(Client $client, JobInvites $jobInvite, Request $request)
    {
        $jobInvite->job_id = $request->jobId;
        $jobInvite->message = $request->message;
        $jobInvite->save();

        return new JobInviteResource($jobInvite);



    }

    public function cancelMyInvite(){

    }
}
