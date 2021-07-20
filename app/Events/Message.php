<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message_id;
    public $conversation_id;
    public $message_info; //message_details:[{sender_user_type:"",sender_id:"",message_type:"", message:"", date:"", time:""} ]

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message_id, $conversation_id, $message_info)
    {
        $this->conversation_id = $conversation_id;
        $this->message_id = $message_id;
        $this->message_info = $message_info;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chat');
    }

    public function broadcastAs(){
        return 'message';
    }
}
