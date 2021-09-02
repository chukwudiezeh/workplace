<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FreelanceResource extends JsonResource
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
            'user_id' => $this->user_id,
            'user' => $this->user,
            'overview' => $this->overview,
            'address' => $this->address,
            'experience_level' => $this->experienceLevel,
            'category' => $this->category,
            'subcategory' => $this->subcategory,
            'hourly_rate' => $this->hourly_rate,
            'job_success_rate' => $this->job_success_rate,
            'position' => $this->position,
            'skills' => $this->skills,
            'earnings' => $this->earnings,
            'created_at' => $this->created_at
        ];
    }
}
