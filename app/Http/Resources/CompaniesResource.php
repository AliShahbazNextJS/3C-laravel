<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompaniesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        // return parent::toArray($request);
        return [
            'legal_name' => $this->legal_name,
            'email' => $this->email,
            'user_id' => $this->user_id,
            'contact' => $this->contact,
            'head_office_address' => $this->head_office_address,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'contact_person' => $this->contact_person,
            'contact_person_designation' => $this->contact_person_designation,
            'contact_person_phone' => $this->contact_person_phone,
            'contact_person_email' => $this->contact_person_email,
            'website' => $this->website,
            'industry' => $this->industry,
            'license_key' => $this->license_key,
            'is_license_key_verified' => $this->is_license_key_verified,
            'status' => $this->status,
            'founded_date' => $this->founded_date,
            'number_of_employees' => $this->number_of_employees,
            'owner_name' => $this->user->name,
            'owner_contact' => $this->user->contact,
            'owner_email' => $this->user->email,
        ];
    }
}
