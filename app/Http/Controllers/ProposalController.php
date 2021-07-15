<?php

namespace App\Http\Controllers;

use App\Events\Hired;
use App\Http\Resources\ProposalResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Freelancer;
use App\Models\Client;
use App\Models\Job;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Freelancer $freelancer)
    {
        $proposals = Proposal::where('freelancer_id','=', $freelancer->id)->get();

        return ProposalResource::collection($proposals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validatr = $this->validator($request->all());

        if ($validatr->fails()){
             return response()->json(['errors' => $validatr->errors()], 401);
        }
        
        $proposal = Proposal::create([
            'freelancer_id' => $request->freelancer_id,
            'job_id' => $request->job_id,
            'cover_letter' => $request->cover_letter,
            'proposed_duration_id' => $request->proposed_duration_id,
            'proposed_fee' => $request->proposed_fee,
        ]);

        return  new ProposalResource($proposal);
//            response()->json(['data'=>$proposal,'message' => 'Proposal sent successfully'], 201);
    }
    
    //validates request
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'cover_letter' => ['bail','required', 'string', 'max:5000'],
//            'milestone' => ['bail', 'required'],
//            'payment_type' => ['bail', 'required','string'],
            'proposed_duration_id' => ['bail', 'required', 'numeric'],
            'proposed_fee' =>['required', 'numeric'],
        ]);
    }

     /**
     * Display the specified resource.
     *
     * @param $freelancer
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function show($freelancer, Proposal $proposal)
    {
        if ($proposal->freelancer_id == $freelancer){
            return response()->json(['data' => $proposal], 200);
        }
        return response()->json(['error' => 'Unauthorised'], 401);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param $freelancer
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $freelancer, Proposal $proposal)
    {
        if ($proposal->freelancer_id == $freelancer){
            $proposal->cover_letter = $request->cover_letter;
            $proposal->milestone = $request->milesatone;
            $proposal->payment_type = $request->payment_type;
            $proposal->estimated_enddate = $request->estimated_enddate;
            $proposal->proposed_fee = $request->proposed_fee;
            $proposal->save();
            return response()->json(['data' => $proposal, 'message'=> 'Updated Successfully']);
        }
        return response()->json(['error' => 'Unauthorised'], 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $freelancer
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function withdrawProposal($freelancer, Proposal $proposal)
    {
        if ($proposal->freelancer_id === $freelancer){
            $proposal->proposal_status_id = 4;
            $proposal->save();
            return response()->json(['massage' => 'Proposal Withdrawn']);
        }
        return response()->json(['error' => 'Unauthorised'], 401);
    }
//client actions
    public function showJobProposals($client, Job $job){
        if ($job->client_id === $client){
            $job_proposals = Proposal::where('job_id',$job);
            return response()->json(['data'=> $job_proposals], 200);
        }
        return response()->json(['error' => 'Unauthorised'], 401);
    }

    public function showOneJobProposal($client, Job $job, Proposal $proposal){
        if ($job->client_id === $client && $job->id == $proposal->job_id){
            return response()->json(['data'=> $proposal], 200);
        }
        return response()->json(['error' => 'Unauthorised'], 401);
    }

    public function declineProposal($client, Job $job, Proposal $proposal){
        if ($job->client_id === $client && $job->id == $proposal->job_id){
            $proposal->proposal_status_id = 3;
            $proposal->save();
            return response()->json(['data'=> $proposal], 200);
        }
        return response()->json(['error' => 'Unauthorised'], 401);
    }

    public function acceptProposal(Client $client, Job $job, Proposal $proposal){
        if ($job->client_id === $client->id && $job->id == $proposal->job_id){
            $proposal->proposal_status_id = 2;
            $proposal->save();

            event(new Hired($client->id,$proposal->freelancer_id,$job->id,$proposal->id,$job->compensation_type_id,$proposal->proposed_fee, $proposal->proposed_enddate));
            return response()->json(['data'=> $proposal], 200);
        }
        return response()->json(['error' => 'Unauthorised'], 401);
    }

    public function requestChangesInProposal($client, Job $job, Proposal $proposal){
        if ($job->client_id === $client && $job->id == $proposal->job_id){
            $proposal->proposal_status_id = 5;
            $proposal->save();
            return response()->json(['data'=> $proposal], 200);
        }
        return response()->json(['error' => 'Unauthorised'], 401);
    }
}
