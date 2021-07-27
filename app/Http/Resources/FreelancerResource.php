<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FreelancerResource extends JsonResource
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
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'phone' => $this->phone,
            'email_verified' => $this->email_verified,
            'phone_verified' => $this->phone_verified,
            'user_type_id' => $this->user_type_id,
            'created_at' => $this->created_at,
            'freelancer' => $this->freelancer
        ];
    }
}
