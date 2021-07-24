<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Messages implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $latest_message;

    /**
     * Create a new event instance.
     *
     *
     * @return void
     */
    public function __construct($latest_message)
    {
        $this->latest_message = $latest_message;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.'. $this->latest_message->conversation_id);
//        foreach($this->conversation->participants as $participant){
//            array_push($channels, new PrivateChannel('chatFreelancer.'. $participant->id));
//        }
    }

    public function broadcastAs(){
        return 'messages';
    }
}
