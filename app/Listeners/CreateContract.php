<?php

namespace App\Listeners;

use App\Events\Hired;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Contract;

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
        $contract = new Contract;
        $contract->client_id = $event->client;
        $contract->freelancer_id = $event->freelancer;
        $contract->job_id = $event->job;
        $contract->proposal_id = $event->proposal;
        $contract->starts_at = date('j/n/Y');
        $contract->ends_at = $event->proposed_enddate;
        $contract->compensation_type_id = $event->compensation_type;
        $contract->contract_fee = $event->contract_fee;

        $contract->save();
    }
}
