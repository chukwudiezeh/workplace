<?php

namespace App\Listeners;

use App\Events\Hired;
use App\Models\Freelancer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Contract;
use App\Models\Conversation;

class CreateContract
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Hired  $event
     * @return void
     */
    public function handle(Hired $event)
    {
        $conversation_check = Conversation::where('job_id', $event->job)->first();

        $contract = new Contract;
        $contract->client_id = $event->client;
        if ($conversation_check == null ){
            $freelancer_dets = Freelancer::where('id', $event->freelancer)->first();
            $freelancer_dets->user;
            $conversation = new Conversation;
            $conversation->title = "General Discussions";
            $conversation->client_id = $event->client;
            $conversation->job_id = $event->job;
            $conversation->participants = ["freelancers" => [$freelancer_dets]];
            $conversation->save();
        }
        else{
            $participants = $conversation_check->participants;
            $freelancer_dets = Freelancer::where('id', $event->freelancer)->first();
            $freelancer_dets->user;

            $freelancers = $participants['freelancers'];
            array_push($freelancers, $freelancer_dets);

            $participants = ["freelancers" => $freelancers];
            $conversation_check->participants = $participants;
            $conversation_check->save();
        }
        $contract->freelancer_id = $event->freelancer;
        $contract->job_id = $event->job;
        $contract->proposal_id = $event->proposal;
        $contract->starts_at = date('Y-m-d');
        $contract->ends_at = $event->ends_at;
        $contract->compensation_type_id = $event->compensation_type;
        $contract->contract_fee = $event->contract_fee;
        $contract->save();
    }
}
