<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobInviteResource extends JsonResource
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
            'message' => $this->message,
            'client_id' => $this->client_id,
            'client' => new ClientResource($this->client),
            'job' => new JobResource($this->job),
            'freelancer_id' => $this->freelancer_id,
            'freelancer' => new FreelanceResource($this->freelancer),
            'created_at' => $this->created_at
        ];
    }
}
