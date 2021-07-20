<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\Contract;
use App\Events\Message;

class MessageController extends Controller
{
    public function getMessages($conversation){
        $messages = Message::where('conversation_id', $conversation)->get();

        return response()->json(['data'=> $messages]);
    }

    public function addMessage(Contract $contract, Conversation $conversation,Message $message, Request $request){
//        $message = new Message;
//
//        $message->conversation_id = $conversation->id;
//        $message_details = $message->message_details;
//        $message->message_details = array_push($message_details,$request->message_details);
//
//        $message->save();

        event(new Message($message->id, $conversation->id, $request->message_info));
    }
}
