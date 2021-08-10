<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class Hired
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $client;
    public $freelancer;
    public $job;
    public $proposal;
    public $compensation_type;
    public $contract_fee;
    public $ends_at;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($client, $freelancer,$job,$proposal,$compensation_type,$contract_fee, $ends_at)
    {
        $this->client = $client;
        $this->freelancer = $freelancer;
        $this->job = $job;
        $this->proposal = $proposal;
        $this->compensation_type = $compensation_type;
        $this->contract_fee = $contract_fee;
        $this->ends_at = $ends_at;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
