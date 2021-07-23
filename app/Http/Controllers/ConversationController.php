<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Contract;


class ConversationController extends Controller
{
    //client actions
    public function getAllConversations($freelancer, Contract $contract, $job){
        $conversations = Conversation::where('job_id', $job)->get();

        return response()->json(['data'=> $conversations]);
    }

    public function create(Request $request){
        $conversation = new Conversation;

        $conversation->title = $request->title;
        $conversation->job_id = $request->job_id;
        $conversation->creator_id = $request->creator_id;
        $conversation->participants = [];
        $conversation->save();

        return response()->json(['data'=> $conversation]);
    }

    public function addParticipant(Conversation $conversation, $freelancer){

        $participants = $conversation->participants;

        array_push($participants, $freelancer);

        $conversation->participants = $participants;
        $conversation->save();

        return response()->json(['data' => $conversation]);

    }
}
