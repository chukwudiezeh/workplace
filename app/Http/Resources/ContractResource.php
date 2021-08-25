<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
//use App\Http\Resources\JobResource;

class ContractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client' => $this->client,
            'freelancer_id' => $this->freelancer_id,
            'job' => new JobResource($this->job),
            'proposal' => new ProposalResource($this->proposal),
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
            'compensation_type' => $this->compensationType,
            'contract_fee' => $this->contract_fee,
            'contract_status' => $this->contractStatus,
            'number_of_hires' => $this->number_of_hires
        ];
    }
}
