<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobResource;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Job;
use App\Models\Client;
use App\Models\Freelancer;


class JobController extends Controller
{
    //freelancer job actions
    public function index(Freelancer $freelancer) {
        $jobs = Job::where([['job_status_id','=',1],['category_id','=',$freelancer->category_id]])->get();
//        $freelancer_skills = \App\Models\FreelanceSkill::where('freelancer_id', $freelancer);
//        foreach($jobs as $job){
//            foreach($freelancer_skills as $freelancer_skill){
//                $skill_required = $job->skill_required;
//                if (in_array($freelancer_skill[1], $skill_required)){
//                    array_push($jobss,$job);
//                }
//            }
//
//        }
//        return response()->json(['data' => $jobs],200);
        return  JobResource::collection($jobs);
    }

    public function show(Job $job){
        return response()->json(['data' => $job], 200);
    }

    public function search($search_string){
        $jobs = Job::where('title', 'like', '%'.$search_string.'%')->get();
        return response()->json(['data' => $jobs], 200);
    }

    public function store(Request $request){
        $validatr = $this->validator($request->all());

        if ($validatr->fails()){
             return response()->json(['errors' => $validatr->errors()], 401);
        }
        
        $job = Job::create([
            'client_id' => $request['client_id'],
            'title' => $request['title'],
            'category_id' => $request['category_id'],
            'subcategory_id' => $request['subcategory_id'],
            'compensation_type_id' => $request['compensation_type'],
            'experience_level_id' => $request['experience_level_id'],
            'job_status_id' => $request['job_status_id'],
            'duration_id' => $request['duration_id'],
            'description' => $request['description'],
            'skills_required' => $request['skills_required'],
            'budget' => $request['budget'],
        ]);

        return response()->json(['data'=> $job,'message' => 'Job created successfully'], 201);
    }

    //validates request
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'category_id' => ['bail','required', 'string','alpha', 'max:2000'],
            'subcategory_id' => ['bail', 'required'],
            'compensation_type_id' => ['bail', 'required','string'],
            'experience_level_id' => ['bail', 'required', 'string'],
            'job_status_id' =>['required', 'numeric'],
            'duration_id' =>['required', 'numeric'],
            'description' =>['required', 'numeric'],
            'skills_required' =>['required', 'numeric'],
            'budget' =>['required', 'numeric'],

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $client
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job, $client)
    {
        if ($job->client_id === $client){
            $job->title = $request->nowr;
            $job->category = $request->milesatone;
            $job->payment_type =$request->payment_type;
            $job->estimated_enddate = $request->estimated_enddate;
            $job->proposed_fee = $request->proposed_fee;
            $job->save();
            return response()->json(['data' => $job, 'message'=> 'Updated Successfully']);
        }
        return response()->json(['error' => 'Unauthorised'], 401);
    }

    public function showAllMyJobs(Client $client){
        $my_jobs = Jobs::where('client_id' === $client);

        return response()->json(['data' => $my_jobs], 200);
    }

    public function showOneJob($client, Job $job){
        if ($job->client_id === $client){
            return response()->json(['data'=> $job], 200);
        }
        return response()->json(['error' => 'Unauthorised'], 401);
    }
}
