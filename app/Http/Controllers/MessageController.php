<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\Contract;
use App\Events\Messages;

class MessageController extends Controller
{
    public function getMessages(Conversation $conversation){
        $messages = Message::where('conversation_id', $conversation->id)->get();

        return response()->json(['data'=> $messages]);
    }

    public function addMessage(Contract $contract, Conversation $conversation, Request $request){
        $message_details = new Message;
        $message_details->conversation_id = $conversation->id;
        $message_details->sender_type = $request->senderType;
        $message_details->sender_id = $request->senderId;
        $message_details->message = $request->message;
        $message_details->message_type = $request->messageType;

        $message_details->save();

        event(new Messages($message_details));
    }
}
