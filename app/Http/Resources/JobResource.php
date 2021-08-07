<?php

namespace App\Http\Resources;

use App\Models\JobInvites;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
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
            'client' => $this->client,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'subcategory' => $this->subcategory,
            'compensation_type' => $this->compensationType,
            'experience_level' => $this->experienceLevel,
            'job_status' => $this->jobStatus,
            'duration' => $this->duration,
            'skills_required' => $this->skills_required,
            'budget' => $this->budget,
//            'proposals' => proposalResource::collection($this->proposals),
//            'job_invites' => JobInviteResource::collection($this->jobInvites),
            'created_at' => $this->created_at
        ];
    }
}
