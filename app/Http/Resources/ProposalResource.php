<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\JobResource;

class ProposalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);

        return [
            'id' => $this->id,
            'freelancer' => new FreelanceResource($this->freelancer),
            'job' => new JobResource($this->job),
            'cover_letter' => $this->cover_letter,
            'milestone' => $this->milestone,
            'payment_type' => $this->payment_type,
            'proposed_duration_id' => $this->proposed_duration_id,
            'proposed_fee' => $this->proposed_fee,
            'proposal_status' => $this->proposalStatus,
            'request_changes' => $this->request_changes,
            'changes_note' => $this->changes_note,
            'created_at' => $this->created_at
        ];
    }
}
