<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'user' => $this->user,
            'user_id' => $this->user_id,
            'address' => $this->address,
            'got_company' => $this->got_company,
            'company_name' => $this->company_name,
            'company_tagline' => $this->company_tagline,
            'company_description' => $this->company_description,
            'company_address' => $this->company_address,
            'company_website' => $this->company_website,
            'company_logo' => $this->company_logo,
            'position_at_company' => $this->position_at_company
        ];
    }
}
